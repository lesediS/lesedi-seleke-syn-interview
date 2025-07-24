<?php
class Database
{
    // XAMPP default database settings
    private $host = 'localhost';
    private $database = 'synrgise_tasks';
    private $username = 'root';
    private $password = ''; // Empty password for XAMPP default
    private $port = 3306;
    private $charset = 'utf8mb4';
    private $pdo;

    public function __construct()
    {
        $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->database};charset={$this->charset}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$this->charset} COLLATE {$this->charset}_unicode_ci"
        ];

        try {
            $this->pdo = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            if ($_SERVER['SERVER_NAME'] !== 'localhost') {
                error_log('Database connection failed: ' . $e->getMessage());
                die('Database connection failed. Please try again later.');
            } else {
                die('Database connection failed: ' . $e->getMessage() .
                    '<br><br><strong>XAMPP Setup Check:</strong><br>' .
                    '1. Is XAMPP running?<br>' .
                    '2. Is MySQL service started?<br>' .
                    '3. Have you imported the database schema?<br>' .
                    '4. Is the database name "synrgise_tasks" correct?');
            }
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }

    public function testConnection()
    {
        try {
            $this->pdo->query('SELECT 1');
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}


// User Authentication Class
class User
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database->getConnection();
    }

    public function login($username, $password)
    {
        try { // Now we fetch the user data including avatar
            $stmt = $this->db->prepare("
            SELECT id, username, email, password_hash, avatar 
            FROM users 
            WHERE username = ? OR email = ?
        ");
            $stmt->execute([$username, $username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password_hash'])) {
                // Storing user data in session including avatar
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['avatar'] = $user['avatar'] ?? 'avatar-1.jpg';

                $this->logActivity($user['id'], 'LOGIN', null, null, ['ip' => $_SERVER['REMOTE_ADDR']]);
                return $user;
            }
            return false;
        } catch (PDOException $e) {
            error_log('Login error: ' . $e->getMessage());
            return false;
        }
    }

    public function checkLoginAttempts($username)
    { // TODO: Necessary?
        $stmt = $this->db->prepare("
        SELECT COUNT(*) as attempts 
        FROM login_attempts 
        WHERE username = ? AND attempt_time > DATE_SUB(NOW(), INTERVAL 15 MINUTE)
    ");
        $stmt->execute([$username]);
        $result = $stmt->fetch();
        return $result['attempts'] < 5; // Allow 5 attempts in 15 minutes
    }

    public function recordLoginAttempt($username, $success)
    {
        $stmt = $this->db->prepare("
        INSERT INTO login_attempts (username, ip_address, user_agent, success) 
        VALUES (?, ?, ?, ?)
    ");
        $stmt->execute([
            $username,
            $_SERVER['REMOTE_ADDR'] ?? null,
            $_SERVER['HTTP_USER_AGENT'] ?? null,
            $success ? 1 : 0
        ]);
    }


    // Register new user 
    public function register($username, $email, $password) // TODO: Necessary?
    {
        try {
            $stmt = $this->db->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
            $stmt->execute([$username, $email]);
            if ($stmt->fetch()) {
                return ['success' => false, 'message' => 'Username or email already exists'];
            }

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("
                INSERT INTO users (username, email, password_hash) 
                VALUES (?, ?, ?)
            ");

            if ($stmt->execute([$username, $email, $passwordHash])) {
                $userId = $this->db->lastInsertId();
                $this->logActivity($userId, 'REGISTER', 'users', $userId);
                return ['success' => true, 'message' => 'Account created successfully'];
            }

            return ['success' => false, 'message' => 'Registration failed'];
        } catch (PDOException $e) {
            error_log('Registration error: ' . $e->getMessage());
            return ['success' => false, 'message' => 'Registration failed: Database error'];
        }
    }

    // Create CSRF token for form submissions
    function generateCsrfToken() // TODO: Necessary?
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    function verifyCsrfToken($token)
    {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }

    public function getUserById($userId)
    {
        try {
            $stmt = $this->db->prepare("SELECT id, username, email, avatar, created_at FROM users WHERE id = ?");
            $stmt->execute([$userId]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log('Get user error: ' . $e->getMessage());
            return false;
        }
    }

    // Logging user activity
    private function logActivity($userId, $action, $tableName = null, $recordId = null, $data = [])
    {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO activity_log (user_id, action, table_name, record_id, new_values, ip_address, user_agent) 
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $userId,
                $action,
                $tableName,
                $recordId,
                json_encode($data),
                $_SERVER['REMOTE_ADDR'] ?? null,
                $_SERVER['HTTP_USER_AGENT'] ?? null
            ]);
        } catch (PDOException $e) {
            error_log('Activity log error: ' . $e->getMessage());
        }
    }
}


// Task management class

class Task
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database->getConnection();
    }

    public function getUserTasks($userId, $status = null)
    {
        try {
            $sql = "SELECT * FROM tasks WHERE user_id = ?";
            $params = [$userId];

            if ($status) {
                $sql .= " AND status = ?";
                $params[] = $status;
            }

            $sql .= " ORDER BY 
                CASE 
                    WHEN status = 'pending' AND due_date < CURDATE() THEN 1
                    WHEN status = 'pending' AND due_date <= DATE_ADD(CURDATE(), INTERVAL 3 DAY) THEN 2
                    WHEN status = 'pending' THEN 3
                    ELSE 4
                END,
                due_date ASC, 
                created_at DESC";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log('Get tasks error: ' . $e->getMessage());
            return [];
        }
    }

    public function createTask($userId, $title, $description, $dueDate)
    {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO tasks (user_id, title, description, due_date) 
                VALUES (?, ?, ?, ?)
            ");
            $result = $stmt->execute([$userId, $title, $description, $dueDate]);

            if ($result) {
                $taskId = $this->db->lastInsertId();
                $this->logTaskActivity($userId, 'CREATE', $taskId, ['title' => $title, 'due_date' => $dueDate]);
            }

            return $result;
        } catch (PDOException $e) {
            error_log('Create task error: ' . $e->getMessage());
            return false;
        }
    }

    public function updateTask($taskId, $userId, $title, $description, $dueDate)
    {
        try {
            $oldTask = $this->getTask($taskId, $userId); // Get old values for logging

            $stmt = $this->db->prepare("
                UPDATE tasks 
                SET title = ?, description = ?, due_date = ?
                WHERE id = ? AND user_id = ?
            ");
            $result = $stmt->execute([$title, $description, $dueDate, $taskId, $userId]);

            if ($result && $oldTask) {
                $this->logTaskActivity($userId, 'UPDATE', $taskId, [
                    'old' => $oldTask,
                    'new' => ['title' => $title, 'description' => $description, 'due_date' => $dueDate]
                ]);
            }

            return $result;
        } catch (PDOException $e) {
            error_log('Update task error: ' . $e->getMessage());
            return false;
        }
    }

    public function markAsCompleted($taskId, $userId) // Task is done
    {
        try {
            $stmt = $this->db->prepare("
                UPDATE tasks 
                SET status = 'completed', completed_at = NOW() 
                WHERE id = ? AND user_id = ?
            ");
            $result = $stmt->execute([$taskId, $userId]);

            if ($result) {
                $this->logTaskActivity($userId, 'COMPLETE', $taskId, ['status' => 'completed']);
            }

            return $result;
        } catch (PDOException $e) {
            error_log('Complete task error: ' . $e->getMessage());
            return false;
        }
    }

    public function deleteTask($taskId, $userId)
    {
        try {
            $task = $this->getTask($taskId, $userId); // Get task for logging

            $stmt = $this->db->prepare("DELETE FROM tasks WHERE id = ? AND user_id = ?");
            $result = $stmt->execute([$taskId, $userId]);

            if ($result && $task) {
                $this->logTaskActivity($userId, 'DELETE', $taskId, $task);
            }

            return $result;
        } catch (PDOException $e) {
            error_log('Delete task error: ' . $e->getMessage());
            return false;
        }
    }

    public function getTask($taskId, $userId)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM tasks WHERE id = ? AND user_id = ?");
            $stmt->execute([$taskId, $userId]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log('Get task error: ' . $e->getMessage());
            return false;
        }
    }

    private function logTaskActivity($userId, $action, $taskId, $data)
    {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO activity_log (user_id, action, table_name, record_id, new_values, ip_address) 
                VALUES (?, ?, 'tasks', ?, ?, ?)
            ");
            $stmt->execute([$userId, $action, $taskId, json_encode($data), $_SERVER['REMOTE_ADDR'] ?? null]);
        } catch (PDOException $e) {
            error_log('Task activity log error: ' . $e->getMessage());
        }
    }
}

// Utility Functions
function formatDate($date, $format = 'd M')
{
    return date($format, strtotime($date));
}

function isOverdue($dueDate)
{
    return strtotime($dueDate) < strtotime('today');
}

function isDueSoon($dueDate)
{
    $dueTimestamp = strtotime($dueDate);
    $today = strtotime('today');
    $threeDaysFromNow = strtotime('+3 days', $today);

    return $dueTimestamp >= $today && $dueTimestamp <= $threeDaysFromNow;
}

function sanitizeInput($data)
{
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

function redirect($url)
{
    if (!headers_sent()) {
        header("Location: $url");
        exit();
    } else {
        echo "<script>window.location.href='$url';</script>";
        exit();
    }
}

// Session management

function startSession()
{
    if (session_status() === PHP_SESSION_NONE) {
        ini_set('session.cookie_httponly', 1);
        ini_set('session.use_only_cookies', 1);

        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            ini_set('session.cookie_secure', 1);
        }

        session_start();

        // Regenerate session ID regularly
        if (!isset($_SESSION['last_regeneration'])) {
            $_SESSION['last_regeneration'] = time();
        } elseif (time() - $_SESSION['last_regeneration'] > 300) { // 5 minutes
            session_regenerate_id(true);
            $_SESSION['last_regeneration'] = time();
        }
    }
}

function isLoggedIn()
{
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

function requireLogin()
{
    if (!isLoggedIn()) {
        redirect('login.php');
    }
}

function getCurrentUser()
{
    return [
        'id' => $_SESSION['user_id'] ?? null,
        'username' => $_SESSION['username'] ?? null,
        'email' => $_SESSION['email'] ?? null,
        'avatar' => $_SESSION['avatar'] ?? 'avatar-1.jpg' ?? null
    ];
}

function setMessage($message, $type = 'info')
{
    $_SESSION['message'] = $message;
    $_SESSION['message_type'] = $type;
}

function getMessage()
{
    if (isset($_SESSION['message'])) {
        $message = [
            'text' => $_SESSION['message'],
            'type' => $_SESSION['message_type'] ?? 'info'
        ];
        unset($_SESSION['message'], $_SESSION['message_type']);
        return $message;
    }
    return null;
}

// App constants
define('APP_NAME', 'Synrgise Task Management');
define('APP_VERSION', '1.0.0');
define('APP_URL', 'http://localhost/synrgise-tasks/');
define('ASSETS_URL', APP_URL . 'assets/');

if ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_NAME'] === '127.0.0.1') { // If localhost does not work use 127.0.0.1
    try {
        $testDb = new Database();
        if (!$testDb->testConnection()) {
            if (basename($_SERVER['PHP_SELF']) !== 'install.php') {
                header('Location: install.php');
                exit();
            }
        }
    } catch (Exception $e) {
        if (basename($_SERVER['PHP_SELF']) !== 'install.php') {
            header('Location: install.php');
            exit();
        }
    }
}

?>