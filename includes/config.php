<?php
$site = [
  'name' => 'Best Online Gaming India',
  'short_name' => 'BOBI',
  'url' => 'https://sports-analytics-hub.com',
  'register_url' => 'https://gamehub.org/#/register?invitationCode=72238107987',
  'telegram_url' => 'https://t.me/bestonlinegameguideindia',
  'invite_code' => '72238107987',
];

$site_reviews = [
  [
    'name' => 'Rohit K.',
    'rating' => 5,
    'date' => '2026-05-01',
    'text' => 'The GameHub access flow felt clear on mobile. I checked the invite code first, reviewed the login page, and understood the wallet steps before starting.',
  ],
  [
    'name' => 'Priya S.',
    'rating' => 5,
    'date' => '2026-05-02',
    'text' => 'The guides made it easier to compare Aviator, Teen Patti and Wingo before opening the account area. The human teacher link is helpful when payment details need checking.',
  ],
  [
    'name' => 'Amit R.',
    'rating' => 5,
    'date' => '2026-05-03',
    'text' => 'I liked having login, bonus and redemption guidance in one place. It feels more organized than jumping between random links and chats.',
  ],
];

$games = [
  ['name' => 'Wingo', 'label' => 'Colour Prediction', 'image' => '/assets/img/provider-games/wingo-thumb.webp', 'url' => '/wingo-game-india/'],
  ['name' => 'Aviator', 'label' => 'Crash Game', 'image' => '/assets/img/provider-games/aviator-thumb.webp', 'url' => '/aviator-gaming-india/'],
  ['name' => 'Teen Patti', 'label' => 'Card Game', 'image' => '/assets/img/provider-games/teen-patti-thumb.webp', 'url' => '/teen-patti-online/'],
  ['name' => 'Cricket', 'label' => 'Sports Gaming', 'image' => '/assets/img/provider-games/cricket-thumb.webp', 'url' => '/cricket-gaming-india/'],
  ['name' => 'Rummy', 'label' => 'Virtual Coins Cards', 'image' => '/assets/img/provider-games/rummy-thumb.webp', 'url' => '/rummy-game-india/'],
  ['name' => 'Slots', 'label' => 'Jackpot Games', 'image' => '/assets/img/provider-games/slots-thumb.webp', 'url' => '/slots-game-india/'],
  ['name' => 'Live Arcade', 'label' => 'Real Dealer', 'image' => '/assets/img/provider-games/live-arcade-thumb.webp', 'url' => '/live-arcade-india/'],
  ['name' => 'Andar Bahar', 'label' => 'Fast Card Round', 'image' => '/assets/img/provider-games/andar-bahar-thumb.webp', 'url' => '/andar-bahar-online/'],
];

function e($value) {
  return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function page_meta($overrides = []) {
  $defaults = [
    'title' => 'GameHub India Guide 2026: Register, Login, Bonus, Games & Redemption',
    'description' => 'Independent GameHub India guide for register, login, bonus, UPI redemption, Aviator, Teen Patti, Wingo, Rummy, cricket gaming and responsible play.',
    'canonical' => 'https://sports-analytics-hub.com/',
  ];
  return array_merge($defaults, $overrides);
}

function bobi_default_cricket_data(): array {
  return [
    'updated_at' => date('c'),
    'source' => 'fallback-cache',
    'featured' => [
      'badge' => 'Daily Watchlist',
      'title' => 'IPL match watchlist updated for today',
      'subtitle' => 'Best Online Gaming India cricket guide - check toss, playing XI and responsible limits before match time',
      'team_a' => [
        'code' => 'IPL',
        'name' => 'Today Match',
        'note' => 'Use the GameHub register path early and avoid rushed match-day decisions',
      ],
      'team_b' => [
        'code' => 'Guide',
        'name' => 'Next Watch',
        'note' => 'Review cricket gaming India, Aviator, Teen Patti, Rummy and Wingo guides before playing',
      ],
      'status_title' => 'Match-day note',
      'status_text' => 'Cricket schedules can change. Check current match feeds and your personal limits before opening any GameHub cricket gaming session.',
      'markets' => [
        ['Today Focus', 'Cricket gaming India'],
        ['GameHub Prep', 'Register, wallet, limits'],
        ['Game Cluster', 'Aviator, Teen Patti, Rummy, Wingo'],
        ['Responsible Play', 'Wait for toss and team news'],
      ],
    ],
    'matches' => [
      [
        'league' => 'Indian Premier League',
        'teams' => 'Today IPL Watchlist',
        'team_a' => 'IPL',
        'team_b' => 'T20',
        'date_label' => 'Today',
        'time_label' => '7:30 PM',
        'venue' => 'India',
        'calendar_dates' => gmdate('Ymd\T140000\Z') . '/' . gmdate('Ymd\T173000\Z'),
      ],
      [
        'league' => 'Indian Premier League',
        'teams' => 'Tomorrow IPL Watchlist',
        'team_a' => 'IPL',
        'team_b' => 'Next',
        'date_label' => 'Tomorrow',
        'time_label' => '7:30 PM',
        'venue' => 'India',
        'calendar_dates' => gmdate('Ymd\T140000\Z', strtotime('+1 day')) . '/' . gmdate('Ymd\T173000\Z', strtotime('+1 day')),
      ],
      [
        'league' => 'Indian Premier League',
        'teams' => 'Upcoming Cricket Watchlist',
        'team_a' => 'T20',
        'team_b' => 'Match',
        'date_label' => date('M j', strtotime('+2 days')),
        'time_label' => '7:30 PM',
        'venue' => 'India',
        'calendar_dates' => gmdate('Ymd\T140000\Z', strtotime('+2 days')) . '/' . gmdate('Ymd\T173000\Z', strtotime('+2 days')),
      ],
    ],
  ];
}

function bobi_normalize_cricket_data(array $payload): array {
  $payload = array_replace_recursive(bobi_default_cricket_data(), $payload);
  $payload['matches'] = array_values(array_slice(array_filter($payload['matches'] ?? [], static function ($match): bool {
    return is_array($match) && trim((string)($match['team_a'] ?? '')) !== '' && trim((string)($match['team_b'] ?? '')) !== '';
  }), 0, 3));

  if (count($payload['matches']) < 1) {
    $payload['matches'] = bobi_default_cricket_data()['matches'];
  }

  return $payload;
}

function bobi_load_cricket_data(): array {
  $cacheFile = dirname(__DIR__) . '/data/cricket.json';
  if (!is_file($cacheFile)) {
    return bobi_default_cricket_data();
  }

  $json = json_decode((string) file_get_contents($cacheFile), true);
  if (!is_array($json)) {
    return bobi_default_cricket_data();
  }

  return bobi_normalize_cricket_data($json);
}
?>
