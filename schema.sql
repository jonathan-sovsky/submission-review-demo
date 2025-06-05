CREATE TABLE submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    status VARCHAR(50)
);

INSERT INTO submissions (title, status) VALUES
('Submission A', 'Pending'),
('Submission B', 'Pending'),
('Submission C', 'Pending');
