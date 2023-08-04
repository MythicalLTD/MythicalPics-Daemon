<?php
include(__DIR__ . "/../base.php");
use phpseclib3\Net\SSH2;

$ssh = new SSH2($_CONFIG['ssh_host'], $_CONFIG['ssh_port']);
if (!$ssh->login($_CONFIG['ssh_username'], $_CONFIG['ssh_password'])) {
    http_response_code(500);
    $rsp = array(
        "code" => 500,
        "error" => "The server is not ready to handle the request.",
        "message" => "SSH connection to node failed."
    );
    die(json_encode($rsp, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}
try {
    $cpuName = $ssh->exec("lscpu | grep 'Model name' | awk -F: '{print $2}' | sed 's/^ *//'");
    $osName = $ssh->exec("lsb_release -s -d");
    $mem_used = $ssh->exec("grep 'MemFree:' /proc/meminfo | awk '{print $2}'");
    $mem_used_mb = intval($mem_used / 1024);
    $mem_total = $ssh->exec("grep 'MemTotal:' /proc/meminfo | awk '{print $2}'");
    $mem_total_mb = intval($mem_total / 1024);
    $mem_free = $mem_total - $mem_used;
    $mem_total_free_mb = intval($mem_free / 1024);
    $disk_info = $ssh->exec("df -B 1 --total | tail -1 | awk '{print $2,$3}'");
    list($disk_total, $disk_used) = explode(" ", $disk_info);
    $disk_total_mb = intval($disk_total / 1024);
    $disk_used_mb = intval($disk_used / 1024);
    $disk_free = $disk_total - $disk_used;
    $disk_free_mb = intval($disk_free / 1024);
    $getuptime = $ssh->exec("cut -d. -f1 /proc/uptime");
    $myuptime = intval($getuptime);
    $u_days = floor($myuptime / (60 * 60 * 24));
    $u_hours = floor(($myuptime % (60 * 60 * 24)) / (60 * 60));
    $u_minutes = floor(($myuptime % (60 * 60)) / 60);
    $u_seconds = $myuptime % 60;
    $uptime = "$u_days days, $u_hours hours, $u_minutes minutes, $u_seconds seconds";
    http_response_code(200);
    $rsp = array(
        "code" => 200,
        "error" => null,
        "message" => "Sure here is the daemon info",
        "stauts" => "Online",
        "hardware" => array(
            "cpu" => trim($cpuName),
            "memory" => array(
                "memory_used" => trim($mem_used_mb),
                "memory_free" => trim($mem_total_free_mb),  
                "memory_total" => trim($mem_total_mb)
            ),
            "disk" => array(
                "disk_used" => trim($disk_used_mb),
                "disk_free" => trim($disk_free_mb),
                "disk_total" => trim($disk_total_mb),
            ),
        ),
        "os" => array(
            "name" => trim($osName), 
            "uptime" => trim($uptime)
        ),
        "daemon" => array(
            "name" => "MythicalPics-Daemon",
            "version" => $_CONFIG['version'],
            "debug" => $_CONFIG['debug'],
        )
    );
    die(json_encode($rsp, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    $ssh->disconnect();
} catch (Exception $ex) {
    http_response_code(500);
    $rsp = array(
        "code" => 500,
        "error" => "The server is not ready to handle the request.",
        "message" => "Faild to get info for daemon: ".$ex
    );
    die(json_encode($rsp, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}
?>