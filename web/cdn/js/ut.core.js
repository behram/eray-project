var $ut = jQuery.noConflict(true);

/*
 * base document values session details
 */
var date = new Date();


var DOCUMENT_ALL = document.all;
var DOCUMENT_IMAGES = document.images;
var DOCUMENT_SCRIPTS = document.scripts;

var S_D = {
    DOCUMENT_TITLE: document.title,
    DOCUMENT_REFERRER: document.referrer,
    DOCUMENT_READY_STATE: document.readyState,
    DOCUMENT_DOMAIN: document.domain,
    DOCUMENT_URL: document.URL,
    DOCUMENT_BASE_URI: document.baseURI,
    DOCUMENT_CHARSET: document.characterSet,
    DOCUMENT_CONTENT_TYPE: document.contentType,
    DOCUMENT_COOKIE: document.cookie,
    N_COOKIE_ENABLED: navigator.cookieEnabled,
    N_USER_AGENT: navigator.userAgent,
    N_VENDOR: navigator.vendor,
    N_PLATFORM: navigator.platform,
    N_LANGUAGES: navigator.languages,
    N_JAVA_ENABLED: navigator.javaEnabled(),
    SESSION_START_TIME: date.getTime(),
    SCREEN_HEIGHT: screen.height,
    SCREEN_WIDTH: screen.width
};

/*
 * site basic log texts
 */
var ADD_SITE_VALUES = 'Please be sure, track-system basic values added!';
var SITE_VALUES_EXIST = 'All site script values exist!';
var SYSTEM_STARTED = 'System started!';
var LOG_SYSTEM_CLOSED = 'Log system is closed please open!';
var JQUERY_ADDED = 'jQuery library added!';
var JQUERY_ALREADY_EXIST = 'jQery library already exists on document!';
var JQUERY_NOT_EXIST = 'jQery library not existing!';
var COOKIE_WORKING = 'Browser cookie system enabled and working!';
var COOKIE_NOT_WORKING = 'Browser cookie system must enabled!';
var NOTY_ADDED = 'Noty library added successfully!';
var NOTY_NOT_WORKING = 'Noty library not working yet! System will reload!';
var SYSTEM_READY = 'System ready to work! Wohooo!';

/*
 *base script urls 
 */
var JQUERY_GET_URL = TRACK_DOMAIN + 'cdn/js/jquery-1.11.2.min.js';
var SITE_AJAX_URL = TRACK_HOME_URL + 'api/public/tracker/events/get/';
var NOTY_GET_URL = TRACK_DOMAIN + 'cdn/js/jquery.noty.v2.3.4.packaged.min.js';
var ADS_GET_URL = TRACK_DOMAIN + 'cdn/js/ads.js';

/*
 * base javascript functions
 */
//websocket support 
var _WEBSOCKET_SUPPORT = function () {

    if ("WebSocket" in window) {

        WEBSOCKET_SUPPORT = true;
    } else {

        WEBSOCKET_SUPPORT = false;
    }
};

//notification box support
var _NOTIFICATION_SUPPORT = function () {

    if (!("Notification" in window)) {

        _CONSOLE_LOG('Device not supports Notification');
        NOTIFICATION_SUPPORT = false;
    } else {

        _CONSOLE_LOG('Device supports Notification');
        NOTIFICATION_SUPPORT = true;
    }
};

//notification permission check
var _NOTIFICATION_PERMISSION_CHECK = function () {

    if (NOTIFICATION_SUPPORT === true) {
        if(Notification.permission === "granted"){

            _CONSOLE_LOG('Device Notification Permission -> granted');
            NOTIFICATION_PERMISSION = true;
        } else if(Notification.permission !== 'denied'){

            _CONSOLE_LOG('Device Notification Permission -> denied');
            NOTIFICATION_PERMISSION = false;
        }
    }
};

//jquery status control
var _JQUERY_STATUS = function () {

    if ("function" === typeof $ut) {

        JQUERY_WORK = true;
    }
};

//jqery script add if not exist
var _JQUERY_ADD = function () {

    var head = document.getElementsByTagName('head')[0];
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = JQUERY_GET_URL;
    head.appendChild(script);
};

//noty library exists
var _NOTY_EXISTS = function () {

    if (JQUERY_WORK === true) {

        if (typeof $ut.noty === 'object') {

            NOTY_WORK = true;
        }
    }
};

//noty library add
var _NOTY_ADD = function () {

    if (JQUERY_WORK === true) {
        var head = document.getElementsByTagName('head')[0];
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = NOTY_GET_URL;
        head.appendChild(script);
    } else {

        NOTY_WORK_INIT = false;
    }
};

//console log system
var _CONSOLE_LOG = function (logValue) {

    if (LOG_SYSTEM) {

        console.log("{Deeply-Notify} -> " + logValue);
    } else {

        console.log("{Deeply-Notify} -> " + LOG_SYSTEM_CLOSED);
    }
};

var _TIMEOUT_RUN = function (_callback, runTime) {

    window.setTimeout(function () {
        _callback();
    }, runTime);
};

var _NOT_COOKIE_SET = function (nDetail) {

    var publish_type = nDetail.schedule.publish_type;

    if (publish_type === 'rightNow' || publish_type === 'everyNewUser') {

        _COOKIE._SET_ITEM('m_' + nDetail.event_hash, date.getTime(), COOKIE_EXPIRE_TIME);
    } else if (publish_type === 'spesificTime' || publish_type === 'everySpesificHour') {

        _COOKIE._SET_ITEM('m_' + nDetail.event_hash, date.getTime(), 60 * 60 * 2);
    } else if (publish_type === 'everyOpenedPage') {

        NOTIFIED_NOTS.push('m_' + nDetail.event_hash);
    }
};

var _DEVICE_UNDEFINED = function () {

    if (is.not.mobile() && is.not.tablet() && is.not.desktop()) {

        return true;
    } else {

        return false;
    }
};

var _NOT_DETAIL_CONTROL = function (notifyNot) {

    delete publish_free;

    publish_free = [];

    publish_free.push(true);

    if (notifyNot.filter.only_adblocked === true) {

        if (IS_ADBLOCK_ENABLED === true) {

            publish_free.push(true);
        } else {
            publish_free.push(false);
        }
    }

    if (notifyNot.filter.on_mobile === false) {

        if (is.mobile()) {

            if (_DEVICE_UNDEFINED()) {

                publish_free.push(true);
            } else {
                publish_free.push(false);
            }
        } else {

            publish_free.push(true);
        }
    }

    if (notifyNot.filter.on_tablet === false) {

        if (is.tablet()) {

            if (_DEVICE_UNDEFINED()) {

                publish_free.push(true);
            } else {
                _CONSOLE_LOG('false add on_tablet');
                publish_free.push(false);
            }
        } else {

            publish_free.push(true);
        }
    }

    if (notifyNot.filter.on_desktop === false) {

        if (is.desktop()) {

            if (_DEVICE_UNDEFINED()) {

                publish_free.push(true);
            } else {
                _CONSOLE_LOG('false add ondesktop');
                publish_free.push(false);
            }
        } else {

            publish_free.push(true);
        }
    }

    if (is.not.mobile() && is.not.tablet() && is.not.desktop()) {

        publish_free.push(true);
    }

    if ($ut.inArray(false, publish_free) === -1) {

        return true;
    } else {

        return false;
    }
};

var _TIME_TO_SECS = function (timeValue) {

    var timeValueSplit = timeValue.split(':');

    return (+timeValueSplit[0]) * 60 * 60 + (+timeValueSplit[1]) * 60 + (+timeValueSplit[2]);
};

var _NOT_TIME_FILTER = function (tControlNot) {

    var dn = new Date();

    timeSplit = new Date().toString().split(' ');
    dateDay = dn.getDate();
    dateMonth = dn.getMonth() + 1;

    if (dateDay < 9) {

        dateDay = '0' + dateDay;
    }
    if (dateMonth < 9) {

        dateMonth = '0' + dateMonth;
    }

    user_date = dateDay + '-' + dateMonth + '-' + dn.getFullYear();
    user_time = timeSplit[4];
    user_datename = week_days[dn.getDay()];
    local_offset = dn.getTimezoneOffset();
    user_timestamp = new Date().getTime() - local_offset * 60 * 1000;

    if (tControlNot.schedule.publish_type === 'rightNow') {

        splitTime = tControlNot.schedule.publish_time.split("-");

        tControlNot.schedule.publish_time = splitTime[1] + '-' + splitTime[0] + '-' + splitTime[2];

        init_publish_time = Date.parse(tControlNot.schedule.publish_time) - local_offset * 60 * 1000;

        last_publish_time = init_publish_time + (60 * tControlNot.schedule.publish_time_lenght * 1000);

        if (user_timestamp > init_publish_time && last_publish_time > user_timestamp) {

            return true;
        } else {

            return false;
        }
    } else if (tControlNot.schedule.publish_type === 'everySpesificHour') {

        splitTime = tControlNot.schedule.publish_time.split("-");
        tControlNot.schedule.publish_time = splitTime[1] + '-' + splitTime[0] + '-' + splitTime[2];

        first_init_publish_time = Date.parse(tControlNot.schedule.publish_time) - local_offset * 60;
        first_last_publish_time = first_init_publish_time + (60 * tControlNot.schedule.publish_time_lenght);

        for (var count = 0; count < 1000; count++) {

            init_publish_time = first_init_publish_time + count * tControlNot.schedule.everySpesificHour_hour * 60 * 60;
            last_publish_time = first_last_publish_time + count * tControlNot.schedule.everySpesificHour_hour * 60 * 60;

            if (user_timestamp > init_publish_time && last_publish_time > user_timestamp) {

                return true;
            }
        }

        return false;
    } else if (tControlNot.schedule.publish_type === 'spesificTime') {

        if (tControlNot.schedule.spesifictime_day_filter.match(/today/g)) {

            split_day_filter = tControlNot.schedule.spesifictime_day_filter.split(',');

            if (user_date === split_day_filter[1]) {

                init_publish_time = _TIME_TO_SECS(tControlNot.schedule.spesifictime_day_filter + ':00');
                last_publish_time = init_publish_time + (60 * tControlNot.schedule.publish_time_lenght);
                user_time_timestamp = _TIME_TO_SECS(user_time);

                if (user_time_timestamp > init_publish_time && last_publish_time > user_time_timestamp) {

                    return true;
                } else {

                    return false;
                }
            } else {

                return false;
            }

        } else if (tControlNot.schedule.spesifictime_day_filter === 'everyday') {

            init_publish_time = _TIME_TO_SECS(tControlNot.schedule.spesifictime_time + ':00');
            last_publish_time = init_publish_time + (60 * tControlNot.schedule.publish_time_lenght);
            user_time_timestamp = _TIME_TO_SECS(user_time);

            if (user_time_timestamp > init_publish_time && last_publish_time > user_time_timestamp) {

                return true;
            } else {

                return false;
            }

        } else if (tControlNot.schedule.spesifictime_day_filter === 'select_days') {

            _CONSOLE_LOG(tControlNot.event_hash + ' ---> event type -> spesificTime -> select_days ');
            if ($ut.inArray(user_datename, JSON.parse(tControlNot.schedule.spesifictime_select_days)) !== -1) {

                _CONSOLE_LOG(tControlNot.event_hash + ' ---> event type -> spesificTime -> select_days -> day ok ');
                init_publish_time = _TIME_TO_SECS(tControlNot.schedule.spesifictime_time + ':00');
                last_publish_time = init_publish_time + (60 * tControlNot.schedule.publish_time_lenght);
                user_time_timestamp = _TIME_TO_SECS(user_time);

                if (user_time_timestamp > init_publish_time && last_publish_time > user_time_timestamp) {

                    return true;
                } else {

                    return false;
                }
            } else {

                return false;
            }
        }
    } else if (tControlNot.schedule.publish_type === 'everyNewUser') {

        return true;
    } else if (tControlNot.schedule.publish_type === 'everyOpenedPage') {

        return true;
    }
};

var _NOTIFY_SYSTEM_INIT = function (notDetail) {

    if (_COOKIE._GET_ITEM('m_' + notDetail.event_hash) === null && $ut.inArray('m_' + notDetail.event_hash, NOTIFIED_NOTS) === -1) {

        if (_NOT_DETAIL_CONTROL(notDetail) === true) {
            if (_NOT_TIME_FILTER(notDetail) === true) {

                if (notDetail.event_type === 'alertBox') {

                    _NS_ALERT(notDetail);
                } else if (notDetail.event_type === 'notificationBox') {

                    _NS_NOTIFICATION_BOX(notDetail);
                } else if (notDetail.event_type === 'messageBox') {

                    _NS_MESSAGE_BOX(notDetail);
                } else if (notDetail.event_type === 'redirect') {

                    _NS_REDIRECT(notDetail);
                } else if (notDetail.event_type === 'link') {

                    _NS_LINK(notDetail);
                } else if (notDetail.event_type === 'iframe') {

                    _NS_IFRAME(notDetail);
                } else if (notDetail.event_type === 'script') {

                    _NS_SCRIPT(notDetail);
                }
            }
        }
    }
};

var _NS_ALERT = function (detail) {

    _ALERT_MESSAGE(detail.event_text);
    _NOTIFY_SERVER(detail);
    _NOT_COOKIE_SET(detail);
};

var _NS_NOTIFICATION_BOX = function (detail) {

    if(_NOTIFICATION_MESSAGE(detail.event_text) === true){

        _NOTIFY_SERVER(detail);
        _NOT_COOKIE_SET(detail);
    }
};

var _NS_MESSAGE_BOX = function (detail) {

    //detail.noty_box.closeWith = ['button'];
    detail.noty_box.layout = detail.noty_box.layout.charAt(0).toLowerCase() + detail.noty_box.layout.substr(1);
    detail.noty_box.text = detail.event_text;

    noty(detail.noty_box);
    _NOTIFY_SERVER(detail);
    _NOT_COOKIE_SET(detail);
};

var _NS_REDIRECT = function (detail) {

    _NOT_COOKIE_SET(detail);
    _NOTIFY_SERVER(detail);
    window.location = detail.event_url;
};

var _NS_LINK = function (detail) {

    _NOT_COOKIE_SET(detail);

    detail.noty_box.layout = detail.noty_box.layout.charAt(0).toLowerCase() + detail.noty_box.layout.substr(1);
    detail.noty_box.text = '<i>' + detail.url_overview + '</i> <br> <b><a href="' + detail.event_url + '">' + detail.event_url + '</a></b>';

    noty(detail.noty_box);
    _NOTIFY_SERVER(detail);
};

var _NS_IFRAME = function (detail) {

    _NOT_COOKIE_SET(detail);

    detail.noty_box.layout = detail.noty_box.layout.charAt(0).toLowerCase() + detail.noty_box.layout.substr(1);
    detail.noty_box.text = '<iframe src="' + detail.event_url + '" width="100%" height="'+detail.iframe_height+'px" style="border:none;outline:none;" id="'+detail.event_hash+'"></iframe>';

    noty(detail.noty_box);
    _SET_NOTY_WIDTH(detail);
    _NOTIFY_SERVER(detail);
};

var _NS_SCRIPT = function (detail) {

    _NOT_COOKIE_SET(detail);

    var head= document.getElementsByTagName('head')[0];
    var script= document.createElement('script');
    script.type= 'text/javascript';
    script.src= detail.event_url;
    head.appendChild(script);
    _NOTIFY_SERVER(detail);
};

var _SET_NOTY_WIDTH = function(detail){

    if($ut("#" + detail.event_hash).length == 0) {
        setTimeout(function(){ _SET_NOTY_WIDTH(detail); }, 100);
    }else{
        $ut('#'+detail.event_hash).closest('li').css('width', detail.iframe_width);
    }
};

var _NOTIFY_SERVER = function(detail){
    $ut.ajax({
        url: TRACK_HOME_URL + 'api/public/credit/reduce/'+detail.event_hash,
        crossDomain: true
    });
};

var _START_WEBSOCKET_SYSTEM = function () {

    WEB_SOCKET = null;
    WEB_SOCKET = new WebSocket(WEBSOCKET_URL + '?hash=' + utsv[0]);
    WEB_SOCKET.onmessage = function (event) {

        $ut.each(JSON.parse(event.data).events, function (index, value) {

            _NOTIFY_SYSTEM_INIT(value);
        });
    }
};

var _SELECT_NOTIFY_SYSTEM = function (FUNCTION_RUN_TIME) {

    if (WEBSOCKET_SUPPORT === true) {

        _CONSOLE_LOG('Device supports WebSocket');
        _START_WEBSOCKET_SYSTEM();
    } else if (WEBSOCKET_SUPPORT === false) {

        _CONSOLE_LOG('Device not supports WebSocket');
        _TIMEOUT_RUN(_NOTIFY_CONTROL_SYSTEM, FUNCTION_RUN_TIME);
    }
};

var _NOTIFY_CONTROL_SYSTEM = function () {

    $ut.ajax({
        url: SITE_AJAX_URL + utsv[0] + '.json',
        crossDomain: true,
        statusCode: {
            200: function (callResponse) {
                if (callResponse.events.length > 0) {

                    $ut.each(callResponse.events, function (index, value) {
                        _NOTIFY_SYSTEM_INIT(value);
                    });
                    _SELECT_NOTIFY_SYSTEM(NOTIFY_RUNTIME);
                } else {

                    _SELECT_NOTIFY_SYSTEM(NOTIFY_RUNTIME);
                }
            },
            404: function () {

                _SELECT_NOTIFY_SYSTEM(NOTIFY_RUNTIME);
            },
            500: function () {

                _SELECT_NOTIFY_SYSTEM(NOTIFY_RUNTIME - 5000);
            },
            403: function () {

                _SELECT_NOTIFY_SYSTEM(NOTIFY_RUNTIME - 5000);
            }
        }
    });
};

//cookie enabled control
var _IS_COOKIE_ENABLED = function () {

    _COOKIE._SET_ITEM(TRY_COOKIE_NAME, 'true', COOKIE_EXPIRE_TIME);

    if (_COOKIE._GET_ITEM(TRY_COOKIE_NAME) === 'true') {

        COOKIE_ENABLED = true;
        return true;
    }
};

//user values control
var _USER_VALUES_CONTROL = function () {

    if (typeof utsv !== 'undefined') {

        if (typeof utsv[0] !== 'undefined' && typeof utsv[1] !== 'undefined') {

            _SET_LOG_SYSTEM_VALUE();
            USER_VALUES_FULL = true;
        } else {

            USER_VALUES_FULL = false;
        }
    } else {

        USER_VALUES_FULL = false;
    }
};

//control if adblocker active
var _IS_ADBLOCK_ACTIVE = function () {

    $ut.ajax({
        url: ADS_GET_URL,
        type: 'get',
        error: function () {

            IS_ADBLOCK_ENABLED = true;
        }
    });

    _TIMEOUT_RUN(_IS_ADBLOCK_ACTIVE, ADBLOCK_RUNTIME);
};

//set log system value
var _SET_LOG_SYSTEM_VALUE = function () {

    if (typeof utsv[1] !== 'undefined') {

        if (utsv[1] === true) {

            LOG_SYSTEM = true;
            return true;
        }
    }
};

//user alert message
var _ALERT_MESSAGE = function (alertMessage) {

    window.alert(alertMessage);
};

//user notification message
var _NOTIFICATION_MESSAGE = function (notificationMessage) {

    if(NOTIFICATION_PERMISSION === true){

        new Notification(notificationMessage);
        return true;
    } else if(NOTIFICATION_PERMISSION === false){

        _REQUEST_NOTIFICATION_PERMISSION();
        window.setTimeout(function () {
            _NOTIFICATION_MESSAGE(notificationMessage);
        }, 2000);
    }
};

//user notification permission request
var _REQUEST_NOTIFICATION_PERMISSION = function () {

    Notification.requestPermission(function (permission) {
        if (permission === "granted") {

            NOTIFICATION_PERMISSION = true;
        } else if(permission === "denied"){

            NOTIFICATION_PERMISSION = false;
        }
    });
};

//all cookie process in one function
var _COOKIE = {
    _GET_ITEM: function (sKey) {
        return decodeURIComponent(document.cookie.replace(new RegExp("(?:(?:^|.*;)\\s*" + encodeURIComponent(sKey).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=\\s*([^;]*).*$)|^.*$"), "$1")) || null;
    },
    _SET_ITEM: function (sKey, sValue, vEnd, sPath, sDomain, bSecure) {
        if (!sKey || /^(?:expires|max\-age|path|domain|secure)$/i.test(sKey)) {
            return false;
        }
        var sExpires = "";
        if (vEnd) {
            switch (vEnd.constructor) {
                case Number:
                    sExpires = vEnd === Infinity ? "; expires=Fri, 31 Dec 9999 23:59:59 GMT" : "; max-age=" + vEnd;
                    break;
                case String:
                    sExpires = "; expires=" + vEnd;
                    break;
                case Date:
                    sExpires = "; expires=" + vEnd.toUTCString();
                    break;
            }
        }
        document.cookie = encodeURIComponent(sKey) + "=" + encodeURIComponent(sValue) + sExpires + (sDomain ? "; domain=" + sDomain : "") + (sPath ? "; path=" + sPath : "; path=/") + (bSecure ? "; secure" : "");
        return true;
    },
    _REMOVE_ITEM: function (sKey, sPath, sDomain) {
        if (!sKey || !this.hasItem(sKey)) {
            return false;
        }
        document.cookie = encodeURIComponent(sKey) + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT" + (sDomain ? "; domain=" + sDomain : "") + (sPath ? "; path=" + sPath : "");
        return true;
    },
    _HAS_ITEM: function (sKey) {
        return (new RegExp("(?:^|;\\s*)" + encodeURIComponent(sKey).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=")).test(document.cookie);
    },
    _KEYS: function () {
        var aKeys = document.cookie.replace(/((?:^|\s*;)[^\=]+)(?=;|$)|^\s*|\s*(?:\=[^;]*)?(?:\1|$)/g, "").split(/\s*(?:\=[^;]*)?;\s*/);
        for (var nIdx = 0; nIdx < aKeys.length; nIdx++) {
            aKeys[nIdx] = decodeURIComponent(aKeys[nIdx]);
        }
        return aKeys;
    }
};

var _JQUERY_BASIC_CONFS = function () {

    $ut.ajaxSetup({
        cache: false,
        type: 'GET'
    });
};

var _NOTY_BASIC_CONFS = function () {

};

var _RANDOM_STRING = function (len, charSet) {

    charSet = charSet || 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var randomString = '';
    for (var i = 0; i < len; i++) {
        var randomPoz = Math.floor(Math.random() * charSet.length);
        randomString += charSet.substring(randomPoz, randomPoz + 1);
    }
    return randomString;
};

var _SET_COOKIE_SYSTEM = function () {

    if (_COOKIE._GET_ITEM('_utsuid_') === null) {

        USER_HASH = _RANDOM_STRING(25);
        _COOKIE._SET_ITEM("_utsuid_", USER_HASH, COOKIE_EXPIRE_TIME);
    }
};

var _SYSTEM_PREPARE = function () {

    if (SYSTEM_IS_PREPARED !== true) {

        //websocket support test
        _WEBSOCKET_SUPPORT();

        //jquery add control
        _JQUERY_STATUS();

        //jquery.noty add control
        _NOTY_EXISTS();

        //check cookie works
        _IS_COOKIE_ENABLED();

        //check user values
        _USER_VALUES_CONTROL();

        _CONSOLE_LOG("System Prepare Start");

        //notification box support test
        _NOTIFICATION_SUPPORT();

        //notification permission check
        _NOTIFICATION_PERMISSION_CHECK();

        if (JQUERY_WORK === true && ONE_TIME_RUN_1 === false) {

            ONE_TIME_RUN_1 = true;

            _JQUERY_BASIC_CONFS();
            _IS_ADBLOCK_ACTIVE();
        }

        if (JQUERY_WORK === true && NOTY_WORK === true && ONE_TIME_RUN_2 === false) {

            ONE_TIME_RUN_2 = true;

            _NOTY_BASIC_CONFS();
            _NOTIFY_CONTROL_SYSTEM();
        }

        if (ONE_TIME_RUN_3 === false) {

            ONE_TIME_RUN_3 = true;

            _SET_COOKIE_SYSTEM();
        }

        if (JQUERY_WORK === true && NOTY_WORK === true && COOKIE_ENABLED === true && USER_VALUES_FULL === true) {

            _CONSOLE_LOG('jQuery Works Perfectly');
            _CONSOLE_LOG('jQuery Noty Works Perfectly');
            _CONSOLE_LOG('Cookie System Works Perfectly');
            _CONSOLE_LOG('User Values Full');

            SYSTEM_IS_PREPARED = true;

        } else {

            if (JQUERY_WORK === false && JQUERY_WORK_INIT === false) {

                _JQUERY_ADD();
                JQUERY_WORK_INIT = true;
            }

            if (NOTY_WORK === false && NOTY_WORK_INIT === false) {

                NOTY_WORK_INIT = true;
                _NOTY_ADD();
            }

            //if system not prepared run again
            _TIMEOUT_RUN(_SYSTEM_PREPARE, 100);
        }
    }
};

/*
 * base system values 
 */

var LOG_SYSTEM = false;

var USER_ONLINE_TIME = 5000;

var NOTIFY_RUNTIME = 30000;

var TRY_COOKIE_NAME = 'cookie_work_try';
var AJAX_RESPONSE;
var JQUERY_WORK = false;
var JQUERY_WORK_INIT = false;

var NOTY_WORK = false;
var NOTY_WORK_INIT = false;

var WEBSOCKET_SUPPORT = false;

var NOTIFICATION_SUPPORT = false;
var NOTIFICATION_PERMISSION = false;

var USER_VALUES_FULL = false;

var COOKIE_ENABLED = false;
var COOKIE_EXPIRE_TIME = 99999999;

var SYSTEM_IS_PREPARED = false;
var SYSTEM_FIRST_PREPARE_RUN = false;

var ONE_TIME_RUN_1 = false;
var ONE_TIME_RUN_2 = false;
var ONE_TIME_RUN_3 = false;
var ONE_TIME_RUN_4 = false;

var IS_ADBLOCK_ENABLED = false;
var ADBLOCK_RUNTIME = 120000;

var NOTIFIED_NOTS = [];

var USER_HASH;

var week_days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

_SYSTEM_PREPARE();

/*
(function () {
    var i = document.createElement('iframe');
    i.style.display = 'none';
    i.onload = function () {
        i.parentNode.removeChild(i);
    };
    i.src = '<?php echo $_GET["request_root"];?>analytic.html';
    document.body.appendChild(i);
})();
*/