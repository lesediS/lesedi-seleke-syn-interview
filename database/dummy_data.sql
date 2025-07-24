-- This script will create dummy data, and it will run after the schema.sql.
USE synrgise_tasks; -- We use the synrgise_tasks database

-- Plain text password is demo123 and it will/is be hashed using PHP password_hash() function
INSERT INTO users (username, email, password_hash, avatar) VALUES -- Added avatars
('demo', 'demo@synrgise.com', '$2y$10$fOjPF1xPxsgyMvWZ.lLoJ.6ivK.z/ujO0GXgLyr87YJTWRXWWc0nW', 'avatar-1.jpg'), 
('john_doe', 'john@example.com', '$2y$10$1zTSrEDRRVqDM3btdcoeiOfXTz9luIhitauqam9Y5xRm2m.5FUPgy', 'avatar-2.jpg'),
('jane_smith', 'jane@example.com', '$2y$10$YZw3jdwPbMmP3ZgE30AyiOWbUF1Z3938rUUG.0lTZjQEcb9DoMFuO', 'avatar-3.jpg'),
('alice_jones', 'alice@example.com', '$2y$10$FtdCA8spMpOCAaAy2EGN8eSwPs7U5ZKCJyyQS/T6eWZ/uxxTcmO8y', 'avatar-4.jpg');

INSERT INTO tasks (user_id, title, description, due_date, status, completed_at) VALUES
-- Pending tasks
(1, 'Complete Project Proposal', 'Finalize the project proposal document and submit for review. Include budget estimates, timeline, and resource requirements.', '2025-07-30', 'pending', NULL),
(1, 'Team Meeting Preparation', 'Prepare agenda and materials for the upcoming team meeting. Review previous meeting notes and action items.', '2025-07-28', 'pending', NULL),
(1, 'Code Review', 'Review pull requests from team members and provide constructive feedback. Focus on code quality, security, and performance.', '2025-07-29', 'pending', NULL),
(1, 'Database Optimization', 'Optimize database queries for better performance. Analyze slow queries and implement indexing strategies.', '2025-08-01', 'pending', NULL),
(1, 'Client Presentation', 'Prepare slides for client presentation next week. Include project progress, milestones, and next steps.', '2025-08-05', 'pending', NULL),
(1, 'Update Documentation', 'Update project documentation with recent changes and new features implemented.', '2025-07-26', 'pending', NULL),
(1, 'Security Audit Review', 'Review security audit findings and implement recommended changes to improve system security.', '2025-07-25', 'pending', NULL),

-- Completed tasks
(1, 'Bug Fixes', 'Fixed critical bugs in the authentication system. Resolved login issues and session management problems.', '2025-07-20', 'completed', '2025-07-20 14:30:00'),
(1, 'API Documentation Update', 'Updated API documentation with new endpoints and improved examples for developers.', '2025-07-18', 'completed', '2025-07-18 16:45:00'),
(1, 'Testing Framework Setup', 'Set up automated testing framework for the project. Configured unit tests and integration tests.', '2025-07-15', 'completed', '2025-07-15 11:20:00'),
(1, 'Initial Security Audit', 'Conducted comprehensive security audit and documented findings and recommendations.', '2025-07-10', 'completed', '2025-07-10 17:15:00'),
(1, 'Database Migration', 'Successfully migrated database to new server with improved performance and backup strategies.', '2025-07-08', 'completed', '2025-07-08 13:45:00'),
(1, 'UI/UX Improvements', 'Implemented user interface improvements based on user feedback and usability testing.', '2025-07-05', 'completed', '2025-07-05 10:30:00'),
(1, 'Performance Monitoring', 'Set up performance monitoring tools and dashboards for real-time system health tracking.', '2025-07-02', 'completed', '2025-07-02 15:20:00');

-- Insert some tasks for the other users
INSERT INTO tasks (user_id, title, description, due_date, status) VALUES
(2, 'Marketing Campaign Analysis', 'Analyze the effectiveness of recent marketing campaigns and provide recommendations.', '2025-08-02', 'pending'),
(2, 'Social Media Strategy', 'Develop comprehensive social media strategy for Q3 2025.', '2025-07-31', 'pending'),
(2, 'Content Creation', 'Create engaging content for the company blog and social media channels.', '2025-08-04', 'pending'),
(2, 'SEO Optimization', 'Optimize website content for better search engine rankings.', '2025-08-06', 'pending'),
(2, 'Email Newsletter Design', 'Design and schedule the monthly email newsletter.', '2025-08-07', 'pending'),
(2, 'Market Research', 'Conduct market research to identify new opportunities and trends.', '2025-08-09', 'pending'),
(3, 'Team Building Activity Planning', 'Plan a team-building activity for next month to improve team cohesion.', '2025-08-01', 'pending'),
(3, 'Budget Review Meeting', 'Prepare for the budget review meeting with the finance team.', '2025-07-29', 'pending'),
(3, 'Client Onboarding Process', 'Review and improve the client onboarding process to enhance customer experience.', '2025-07-27', 'pending'),
(3, 'Sales Strategy Session', 'Conduct a strategy session to improve sales techniques and customer engagement.', '2025-08-08', 'pending'),
(3, 'Product Feature Testing', 'Test new product features and gather feedback from beta users.', '2025-08-11', 'pending'),
(3, 'Customer Feedback Review', 'Review and categorize customer feedback from last quarter.', '2025-08-03', 'pending'),
(3, 'Product Roadmap Planning', 'Plan product roadmap for the next 6 months based on market research.', '2025-08-10', 'pending');