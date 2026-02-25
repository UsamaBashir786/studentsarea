<?php
// config/Application.php
require_once 'database.php';

class Application {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Submit author application
    public function submitAuthorApplication($user_id, $data) {
        try {
            $query = "INSERT INTO author_applications 
                     (user_id, full_name, expertise, bio, portfolio_url, writing_samples) 
                     VALUES 
                     (:user_id, :full_name, :expertise, :bio, :portfolio_url, :writing_samples)";

            $stmt = $this->conn->prepare($query);

            // Sanitize inputs
            $full_name = htmlspecialchars(strip_tags($data['full_name']));
            $expertise = htmlspecialchars(strip_tags($data['expertise']));
            $bio = htmlspecialchars(strip_tags($data['bio']));
            $portfolio_url = filter_var($data['portfolio_url'], FILTER_SANITIZE_URL);
            $writing_samples = htmlspecialchars(strip_tags($data['writing_samples']));

            $stmt->bindParam(":user_id", $user_id);
            $stmt->bindParam(":full_name", $full_name);
            $stmt->bindParam(":expertise", $expertise);
            $stmt->bindParam(":bio", $bio);
            $stmt->bindParam(":portfolio_url", $portfolio_url);
            $stmt->bindParam(":writing_samples", $writing_samples);

            if ($stmt->execute()) {
                return array(
                    "success" => true,
                    "message" => "Author application submitted successfully!",
                    "application_id" => $this->conn->lastInsertId()
                );
            }
            return array("success" => false, "message" => "Failed to submit application.");
        } catch (PDOException $e) {
            return array("success" => false, "message" => "Database error: " . $e->getMessage());
        }
    }

    // Submit company application
    public function submitCompanyApplication($user_id, $data) {
        try {
            $query = "INSERT INTO company_applications 
                     (user_id, company_name, industry, website, company_size, description, contact_person, contact_position) 
                     VALUES 
                     (:user_id, :company_name, :industry, :website, :company_size, :description, :contact_person, :contact_position)";

            $stmt = $this->conn->prepare($query);

            // Sanitize inputs
            $company_name = htmlspecialchars(strip_tags($data['company_name']));
            $industry = htmlspecialchars(strip_tags($data['industry']));
            $website = filter_var($data['website'], FILTER_SANITIZE_URL);
            $company_size = htmlspecialchars(strip_tags($data['company_size']));
            $description = htmlspecialchars(strip_tags($data['description']));
            $contact_person = htmlspecialchars(strip_tags($data['contact_person']));
            $contact_position = htmlspecialchars(strip_tags($data['contact_position']));

            $stmt->bindParam(":user_id", $user_id);
            $stmt->bindParam(":company_name", $company_name);
            $stmt->bindParam(":industry", $industry);
            $stmt->bindParam(":website", $website);
            $stmt->bindParam(":company_size", $company_size);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":contact_person", $contact_person);
            $stmt->bindParam(":contact_position", $contact_position);

            if ($stmt->execute()) {
                return array(
                    "success" => true,
                    "message" => "Company application submitted successfully!",
                    "application_id" => $this->conn->lastInsertId()
                );
            }
            return array("success" => false, "message" => "Failed to submit application.");
        } catch (PDOException $e) {
            return array("success" => false, "message" => "Database error: " . $e->getMessage());
        }
    }

    // Submit job posting
    public function submitJobPosting($user_id, $data) {
        try {
            $query = "INSERT INTO job_postings 
                     (user_id, title, job_type, location, category, salary, duration, description, requirements, benefits, application_email) 
                     VALUES 
                     (:user_id, :title, :job_type, :location, :category, :salary, :duration, :description, :requirements, :benefits, :application_email)";

            $stmt = $this->conn->prepare($query);

            // Sanitize inputs
            $title = htmlspecialchars(strip_tags($data['title']));
            $job_type = htmlspecialchars(strip_tags($data['job_type']));
            $location = htmlspecialchars(strip_tags($data['location']));
            $category = htmlspecialchars(strip_tags($data['category']));
            $salary = htmlspecialchars(strip_tags($data['salary']));
            $duration = htmlspecialchars(strip_tags($data['duration']));
            $description = htmlspecialchars(strip_tags($data['description']));
            $requirements = htmlspecialchars(strip_tags($data['requirements']));
            $benefits = htmlspecialchars(strip_tags($data['benefits']));
            $application_email = filter_var($data['application_email'], FILTER_SANITIZE_EMAIL);

            $stmt->bindParam(":user_id", $user_id);
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":job_type", $job_type);
            $stmt->bindParam(":location", $location);
            $stmt->bindParam(":category", $category);
            $stmt->bindParam(":salary", $salary);
            $stmt->bindParam(":duration", $duration);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":requirements", $requirements);
            $stmt->bindParam(":benefits", $benefits);
            $stmt->bindParam(":application_email", $application_email);

            if ($stmt->execute()) {
                return array(
                    "success" => true,
                    "message" => "Job posted successfully!",
                    "job_id" => $this->conn->lastInsertId()
                );
            }
            return array("success" => false, "message" => "Failed to post job.");
        } catch (PDOException $e) {
            return array("success" => false, "message" => "Database error: " . $e->getMessage());
        }
    }

    // Get user applications
    public function getUserApplications($user_id) {
        $applications = [];

        // Get author applications
        $author_query = "SELECT * FROM author_applications WHERE user_id = :user_id ORDER BY submitted_at DESC";
        $author_stmt = $this->conn->prepare($author_query);
        $author_stmt->bindParam(":user_id", $user_id);
        $author_stmt->execute();
        $applications['author'] = $author_stmt->fetchAll(PDO::FETCH_ASSOC);

        // Get company applications
        $company_query = "SELECT * FROM company_applications WHERE user_id = :user_id ORDER BY submitted_at DESC";
        $company_stmt = $this->conn->prepare($company_query);
        $company_stmt->bindParam(":user_id", $user_id);
        $company_stmt->execute();
        $applications['company'] = $company_stmt->fetchAll(PDO::FETCH_ASSOC);

        // Get job postings
        $job_query = "SELECT * FROM job_postings WHERE user_id = :user_id ORDER BY created_at DESC";
        $job_stmt = $this->conn->prepare($job_query);
        $job_stmt->bindParam(":user_id", $user_id);
        $job_stmt->execute();
        $applications['jobs'] = $job_stmt->fetchAll(PDO::FETCH_ASSOC);

        return $applications;
    }
}
?>