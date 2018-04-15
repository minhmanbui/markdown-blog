<?php

namespace App\Models;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends AbstractModel
{
    use SoftDeletes; //avoid delete completed in db

    const POST_STATUS_PENDING = 1;
    const POST_STATUS_APPROVED = 2;

    protected $table = 'posts';
    protected $primaryKey = 'p_id';

    protected $fillable = [
        'p_title', 'p_content'
    ];

    public function creater()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function approver()
    {
        return $this->hasOne(User::class, 'id', 'approved_by');
    }

    public function editer()
    {
        return $this->hasOne(User::class, 'id', 'edited_by');
    }


    public function isApproved()
    {
        return $this->getStatus() == self::POST_STATUS_APPROVED;
    }

    public function setApprover(User $approver)
    {
        $this->approved_by = $approver->getId();

        return $this;
    }

    public function setModifier(User $modifier)
    {
        $this->modified_by = $modifier->getId();

        return $this;
    }

    public function setStatus($status)
    {
        $this->p_status = $status;

        return $this;
    }

    public function getTitle()
    {
        return $this->p_title;
    }

    public function getContent()
    {
        return $this->p_content;
    }

    public function getStatus()
    {
        return $this->p_status;
    }

    public function getCreatedDate()
    {
        return $this->created_at;
    }

    public function getModifiedDate()
    {
        if (!$this->updated_at) {
            return;
        }

        if ($this->updated_at->getTimestamp() == $this->getCreatedDate()->getTimestamp()) {
            return;
        }

        return $this->updated_at;
    }

    public function getCreater()
    {
        return $this->creater()->first();
    }

    public function getApprover()
    {
        return $this->approver()->first();
    }
}
