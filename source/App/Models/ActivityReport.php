<?php

namespace App\Models;

class ActivityReport extends Model
{
    public function __construct()
    {
        parent::__construct("activity_report", ["last_report", "last_page"]);
    }

    /**
     * @param User $user
     * @param array $data
     * @return boolean
     */
    public function set(User $user, array $data): bool
    {
        if (empty($this->users_id))
            $this->users_id = $user->id;

        $this->last_report = date("Y-m-d H:i:s");
        $this->last_page = $data["last_page"];

        return true;
    }
}
