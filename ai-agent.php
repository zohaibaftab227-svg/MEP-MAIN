<?php
/**
 * Fiza e Haram - AI Assistant Endpoint
 *
 * This is a lightweight, database-driven assistant: it matches the visitor's
 * message against keyword sets stored in the `ai_knowledge` table (editable
 * from the Admin Panel) and returns the most relevant response.
 *
 * TIP: To upgrade this into a true LLM-powered agent, replace the matching
 * logic below with a call to your preferred AI provider's API (e.g. send
 * $message plus your services/FAQ data as context, and return the model's
 * reply as JSON). Keep the same JSON response shape: {"reply": "..."}
 */

header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$message = trim($_POST['message'] ?? '');

if ($message === '') {
    echo json_encode(['reply' => 'Please type a message so I can help you.']);
    exit;
}

$messageLower = mb_strtolower($message);
$bestReply = null;
$bestScore = 0;

try {
    $rows = $pdo->query("SELECT keywords, response FROM ai_knowledge WHERE status = 1")->fetchAll();
    foreach ($rows as $row) {
        $keywords = array_map('trim', explode(',', mb_strtolower($row['keywords'])));
        $score = 0;
        foreach ($keywords as $kw) {
            if ($kw !== '' && mb_strpos($messageLower, $kw) !== false) {
                $score += strlen($kw); // longer/more specific matches score higher
            }
        }
        if ($score > $bestScore) {
            $bestScore = $score;
            $bestReply = $row['response'];
        }
    }
} catch (Exception $e) {
    // Table might not exist yet; fall through to default reply.
}

if ($bestReply === null) {
    $phone = get_setting($pdo, 'phone', '0300-4720066');
    $bestReply = "Thanks for your message! For a quick and detailed answer, please contact our team directly on WhatsApp at {$phone}, or ask me about our Hajj packages, Umrah packages, visa processing, or pricing.";
}

echo json_encode(['reply' => $bestReply]);
