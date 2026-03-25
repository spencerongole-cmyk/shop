<?php
/**
 * api.php — Attendance data API
 * Place this file in the SAME folder as attendance-login.html
 * Data is stored in attendance-data.json in the same folder.
 *
 * GET  api.php        → returns full JSON data
 * POST api.php        → saves full JSON data (body = JSON string)
 */

// Allow the HTML page (same origin) to call this
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

$dataFile = __DIR__ . '/attendance-data.json';

// ── GET: return stored data ──────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (file_exists($dataFile)) {
        $raw = file_get_contents($dataFile);
        // Validate it's proper JSON before sending
        $decoded = json_decode($raw, true);
        if ($decoded !== null) {
            echo $raw;
        } else {
            // Corrupted file — return empty structure
            echo json_encode(['employees' => [], 'attendance' => [], 'leaves' => []]);
        }
    } else {
        // First run — return empty structure
        echo json_encode(['employees' => [], 'attendance' => [], 'leaves' => []]);
    }
    exit;
}

// ── POST: save data ──────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $body = file_get_contents('php://input');

    // Validate JSON before writing
    $decoded = json_decode($body, true);
    if ($decoded === null) {
        http_response_code(400);
        echo json_encode(['ok' => false, 'error' => 'Invalid JSON received']);
        exit;
    }

    // Ensure required keys exist
    $safe = [
        'employees'  => isset($decoded['employees'])  ? $decoded['employees']  : [],
        'attendance' => isset($decoded['attendance']) ? $decoded['attendance'] : [],
        'leaves'     => isset($decoded['leaves'])     ? $decoded['leaves']     : [],
    ];

    // Write with file locking to prevent concurrent write corruption
    $result = file_put_contents(
        $dataFile,
        json_encode($safe, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
        LOCK_EX
    );

    if ($result === false) {
        http_response_code(500);
        echo json_encode(['ok' => false, 'error' => 'Could not write to attendance-data.json. Check folder permissions.']);
    } else {
        echo json_encode(['ok' => true, 'bytes' => $result]);
    }
    exit;
}

// Anything else
http_response_code(405);
echo json_encode(['ok' => false, 'error' => 'Method not allowed']);
