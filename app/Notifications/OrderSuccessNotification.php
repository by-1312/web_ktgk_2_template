<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderSuccessNotification extends Notification
{
    use Queueable;

    protected $donHang;

    public function __construct($donHang)
    {
        $this->donHang = $donHang;
    }

    public function via($notifiable)
    {
        return ['mail']; // Gửi qua đường Email
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Thông báo đặt hàng thành công')
                    ->greeting('Chào ' . $notifiable->name . '!')
                    ->line('Cảm ơn bạn đã đặt hàng tại cửa hàng Cây Cảnh của chúng tôi.')
                    ->line('Mã đơn hàng của bạn là: #' . $this->donHang->ma_don_hang)
                    ->line('Chúng tôi sẽ sớm liên hệ để xác nhận đơn hàng.')
                    ->action('Xem chi tiết đơn hàng', url('/'))
                    ->line('Chúc bạn một ngày tốt lành!');
    }
}