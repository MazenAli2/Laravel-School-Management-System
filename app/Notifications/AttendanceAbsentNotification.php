<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AttendanceAbsentNotification extends Notification
{
    use Queueable;

    protected $student;
    protected $attendanceDate;

    /**
     * Create a new notification instance.
     */
    public function __construct($student, $attendanceDate)
    {
        $this->student = $student;
        $this->attendanceDate = $attendanceDate;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'student_name' => $this->student->user->name,
            'attendance_date' => $this->attendanceDate,
            'status' => 'Absent',
            'message' => "Your child {$this->student->user->name} was marked Absent on {$this->attendanceDate}.",
        ];
    }
}
