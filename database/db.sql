CREATE TABLE remote_jobs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    company_name VARCHAR(255) NOT NULL,
    description TEXT,
    skills_required JSON,
    hourly_rate DECIMAL(10,2),
    job_type ENUM('part_time', 'full_time', 'contract', 'freelance', 'internship'),
    experience_level ENUM('student', 'entry', 'junior', 'mid'),
    category VARCHAR(100),
    is_remote BOOLEAN DEFAULT TRUE,
    remote_type ENUM('fully_remote', 'hybrid', 'flexible'),
    application_deadline DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert sample data
INSERT INTO remote_jobs (title, company_name, description, skills_required, hourly_rate, job_type, experience_level, category, is_remote, remote_type, application_deadline) VALUES
('Frontend Developer Intern', 'TechCorp Solutions', 'We are looking for a Frontend Developer Intern to join our team...', '["HTML", "CSS", "JavaScript", "React"]', 18.50, 'internship', 'student', 'web_development', TRUE, 'fully_remote', DATE_ADD(NOW(), INTERVAL 30 DAY)),
('UI/UX Designer', 'Creative Studio', 'Looking for a talented UI/UX designer to create beautiful interfaces...', '["Figma", "Adobe XD", "Wireframing", "Prototyping"]', 22.00, 'part_time', 'entry', 'design', TRUE, 'fully_remote', DATE_ADD(NOW(), INTERVAL 45 DAY)),
('Content Writer', 'Digital Marketing Hub', 'Write engaging blog posts and articles for various clients...', '["Copywriting", "SEO", "Blogging", "Research"]', 15.00, 'freelance', 'student', 'writing', TRUE, 'flexible', DATE_ADD(NOW(), INTERVAL 60 DAY)),
('Social Media Manager', 'BrandBoost Agency', 'Manage social media accounts and create content calendars...', '["Social Media", "Content Creation", "Analytics", "Strategy"]', 16.50, 'part_time', 'entry', 'marketing', TRUE, 'hybrid', DATE_ADD(NOW(), INTERVAL 20 DAY)),
('Data Analyst', 'DataWise Analytics', 'Analyze datasets and create reports for business insights...', '["Python", "Excel", "SQL", "Data Visualization"]', 25.00, 'contract', 'junior', 'data', TRUE, 'fully_remote', DATE_ADD(NOW(), INTERVAL 35 DAY));