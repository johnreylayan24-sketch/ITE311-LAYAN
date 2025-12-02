<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityModel extends Model
{
    protected $table = 'activities';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['user_id', 'activity_type', 'description', 'ip_address', 'user_agent'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * Log user activity
     *
     * @param int $userId
     * @param string $activityType
     * @param string $description
     * @return bool|int|string
     */
    public function logActivity($userId, $activityType, $description = '')
    {
        $request = service('request');
        
        $data = [
            'user_id' => $userId,
            'activity_type' => $activityType,
            'description' => $description,
            'ip_address' => $request->getIPAddress(),
            'user_agent' => $request->getUserAgent()->getAgentString()
        ];

        return $this->insert($data);
    }

    /**
     * Get recent activities
     *
     * @param int $limit
     * @return array
     */
    public function getRecentActivities($limit = 10)
    {
        return $this->select('activities.*, users.first_name, users.last_name')
            ->join('users', 'users.id = activities.user_id')
            ->orderBy('activities.created_at', 'DESC')
            ->findAll($limit);
    }

    /**
     * Get activities by user
     *
     * @param int $userId
     * @param int $limit
     * @return array
     */
    public function getUserActivities($userId, $limit = 10)
    {
        return $this->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->findAll($limit);
    }

    /**
     * Get activities by type
     *
     * @param string $activityType
     * @param int $limit
     * @return array
     */
    public function getActivitiesByType($activityType, $limit = 10)
    {
        return $this->where('activity_type', $activityType)
            ->orderBy('created_at', 'DESC')
            ->findAll($limit);
    }
}
