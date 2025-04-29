<?php

/*
 | --------------------------------------------------------------------
 | App Namespace
 | --------------------------------------------------------------------
 |
 | This defines the default Namespace that is used throughout
 | CodeIgniter to refer to the Application directory. Change
 | this constant to change the namespace that all application
 | classes should use.
 |
 | NOTE: changing this will require manually modifying the
 | existing namespaces of App\* namespaced-classes.
 */
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
 | --------------------------------------------------------------------------
 | Composer Path
 | --------------------------------------------------------------------------
 |
 | The path that Composer's autoload file is expected to live. By default,
 | the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
 |--------------------------------------------------------------------------
 | Timing Constants
 |--------------------------------------------------------------------------
 |
 | Provide simple ways to work with the myriad of PHP functions that
 | require information to be in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2_592_000);
defined('YEAR')   || define('YEAR', 31_536_000);
defined('DECADE') || define('DECADE', 315_360_000);

/*
 | --------------------------------------------------------------------------
 | Exit Status Codes
 | --------------------------------------------------------------------------
 |
 | Used to indicate the conditions under which the script is exit()ing.
 | While there is no universal standard for error codes, there are some
 | broad conventions.  Three such conventions are mentioned below, for
 | those who wish to make use of them.  The CodeIgniter defaults were
 | chosen for the least overlap with these conventions, while still
 | leaving room for others to be defined in future versions and user
 | applications.
 |
 | The three main conventions used for determining exit status codes
 | are as follows:
 |
 |    Standard C/C++ Library (stdlibc):
 |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
 |       (This link also contains other GNU-specific conventions)
 |    BSD sysexits.h:
 |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
 |    Bash scripting:
 |       http://tldp.org/LDP/abs/html/exitcodes.html
 |
 */
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0);        // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1);          // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3);         // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4);   // file not found
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5);  // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7);     // invalid user input
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8);       // database error
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9);      // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125);    // highest automatically-assigned error code

defined('EVENT_START_DATE')      || define('EVENT_START_DATE', 'Ngày bắt đầu');    // 
defined('EVENT_END_DATE')      || define('EVENT_END_DATE', 'Ngày kết thúc');    // 

defined('ADDRESS')      || define('ADDRESS', 'Địa chỉ');    // 

defined('EVENT_LOCATION_MAP')      || define('EVENT_LOCATION_MAP', 'Bản đồ');    // 

defined('SHARE_THIS_EVENT')      || define('SHARE_THIS_EVENT', 'Chia sẻ');    // 
defined('SIDEBAR_EVENT_HEADING_1')      || define('SIDEBAR_EVENT_HEADING_1', 'Side bar');    // 

defined('START_DATE')      || define('START_DATE', 'Ngày bắt đầu');    // 

defined('SIDEBAR_EVENT_HEADING_2')      || define('SIDEBAR_EVENT_HEADING_2', 'Side bar');    // 
//defined('EVENT_START_DATE')      || define('EVENT_START_DATE', 'Ngày bắt đầu');    // 

defined('READ_MORE')      || define('READ_MORE', 'Xem tiếp');    // 
defined('SIDEBAR_NEWS_HEADING_1')      || define('SIDEBAR_NEWS_HEADING_1', 'Side Bar');    // 
defined('SEARCH_FOR')      || define('SEARCH_FOR', 'Tìm ...');    // 
defined('SIDEBAR_NEWS_HEADING_2')      || define('SIDEBAR_NEWS_HEADING_2', 'Side Bar');    // 
defined('SHARE_THIS_NEWS')      || define('SHARE_THIS_NEWS', 'Chia sẻ tin này');    // 
defined('COMMENT')      || define('COMMENT', 'Phản hồi');    // 

defined('ALL')      || define('ALL', 'Tất cả');    // 
defined('PROJECT_OVERVIEW')      || define('PROJECT_OVERVIEW', 'Tổng quan dự án');    // 


defined('SIDEBAR_PORTFOLIO_HEADING_1')      || define('SIDEBAR_PORTFOLIO_HEADING_1', 'SaideBar');    // 
defined('SIDEBAR_PORTFOLIO_HEADING_2')      || define('SIDEBAR_PORTFOLIO_HEADING_2', 'SaideBar');    // 

defined('CLIENT_NAME')      || define('CLIENT_NAME', 'Tên khách hàng');    // 
defined('CLIENT_COMPANY_NAME')      || define('CLIENT_COMPANY_NAME', 'Tên công ty khách hàng');    // 
defined('PROJECT_START_DATE')      || define('PROJECT_START_DATE', 'Ngày bắt đầu');    // 

defined('PROJECT_END_DATE')      || define('PROJECT_END_DATE', 'Ngày bắt đầu');    // 
defined('CLIENT_COMMENT')      || define('CLIENT_COMMENT', 'Nhận xét của khách hàng');    // 

defined('NAME')      || define('NAME', 'Tên');    // 
defined('EMAIL_ADDRESS')      || define('EMAIL_ADDRESS', 'Email');    // 

defined('PHONE_NUMBER')      || define('PHONE_NUMBER', 'Điện thoại');    // 

defined('MESSAGE')      || define('MESSAGE', 'Nội dung');    // 

defined('SUBMIT')      || define('SUBMIT', 'Gửi');    // 
defined('RECENT_PORTFOLIO')      || define('RECENT_PORTFOLIO', 'RECENT_PORTFOLIO');    // 
defined('RECENT_PORTFOLIO_SUBTITLE')      || define('RECENT_PORTFOLIO_SUBTITLE', 'RECENT_PORTFOLIO');    // 
defined('NEWS_DATE')      || define('NEWS_DATE', 'Ngày');    // 
defined('CONTACT')      || define('CONTACT', 'Liên hệ');    // 

defined('PROJECT_MODE')      || define('PROJECT_MODE',1);
defined('PROJECT_NOTIFICATION')      || define('PROJECT_NOTIFICATION','Data can not be changed in demo');

defined('SIDEBAR_SERVICE_HEADING_1')      || define('SIDEBAR_SERVICE_HEADING_1', 'Slide bar heading 1'); 
defined('SIDEBAR_SERVICE_HEADING_2')      || define('SIDEBAR_SERVICE_HEADING_2', 'Slide bar heading 2'); 

defined('HOME')      || define('HOME', 'Trang chủ'); 
defined('TERMS_AND_CONDITIONS')      || define('TERMS_AND_CONDITIONS', 'Điều khoản sử dụng'); 
defined('PRIVACY_POLICY')      || define('PRIVACY_POLICY', 'Chính sách'); 


defined('FOOTER_1_HEADING')      || define('FOOTER_1_HEADING', 'FOOTER_1_HEADING'); 
defined('FOOTER_2_HEADING')      || define('FOOTER_2_HEADING', 'FOOTER_2_HEADING'); 
defined('FOOTER_3_HEADING')      || define('FOOTER_3_HEADING', 'FOOTER_3_HEADING'); 
defined('FOOTER_4_HEADING')      || define('FOOTER_4_HEADING', 'FOOTER_4_HEADING'); 

defined('PRIVACY_POLICY')      || define('PRIVACY_POLICY1', 'Chính sách'); 

defined('PRIVACY_POLICY')      || define('PRIVACY_POLICY2', 'Chính sách'); 

defined('PRIVACY_POLICY')      || define('PRIVACY_POLICY3', 'Chính sách'); 
defined('NO_RESULT_FOUND')      || define('NO_RESULT_FOUND', 'Không tìm thấy kết quả phù hợp'); 
