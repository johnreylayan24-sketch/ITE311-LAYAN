<?php

namespace App\Controllers;

use App\Models\EnrollmentModel;
use CodeIgniter\Controller;

class Course extends Controller
{
    public function enroll()
    {
        $session = session();

        if (!$session->has('isLoggedIn') || !$session->get('isLoggedIn')) {
            return $this->response->setStatusCode(401)
                                  ->setJSON(['message' => 'Unauthorized']);
        }

        $course_id = $this->request->getPost('course_id');
        $user_id = $session->get('user_id');

        $enrollmentModel = new EnrollmentModel();

        if (!is_numeric($course_id)) {
            return $this->response->setStatusCode(400)
                                  ->setJSON(['message' => 'Invalid course ID']);
        }

        if ($enrollmentModel->isAlreadyEnrolled($user_id, $course_id)) {
            return $this->response->setJSON(['message' => 'Already enrolled']);
        }

        $enrollmentModel->enrollUser($user_id, $course_id);

        return $this->response->setJSON(['message' => 'Enrollment successful']);
    }
}
