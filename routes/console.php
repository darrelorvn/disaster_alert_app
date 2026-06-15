<?php

use Illuminate\Support\Facades\Schedule;

// TODO: enable after BMKG integration is implemented.
// Schedule::command('bmkg:sync')->everyFifteenMinutes();

Schedule::command('scrape:bnpb-news')->hourly();
