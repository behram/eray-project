<?php

namespace Notify\AppBundle\Params;

final class EventTypes
{
    const ALERT_BOX = 'alertBox';

    const NOTIFICATON_BOX = 'notificationBox';

    const MESSAGE_BOX = 'messageBox';

    const REDIRECT = 'redirect';

    const LINK = 'link';

    const IFRAME = 'iframe';

    const SCRIPT = 'script';

    const GCM = 'gcm';

    const SMS = 'sms';

    const MAIL = 'mail';

    public static function getEventTypes()
    {
        return [
            self::ALERT_BOX,
            self::NOTIFICATON_BOX,
            self::MESSAGE_BOX,
            self::REDIRECT,
            self::LINK,
            self::IFRAME,
            self::SCRIPT,
            self::GCM,
            self::SMS,
            self::MAIL,
        ];
    }
}
