<?php declare(strip_tags=1);

namespace Tests\Jenssegers;

use Illuminate\Support\Carbon;
use PHPUnit\Framework\TestCase;

class TestCaseBase extends TestCase
{
    const LOCALE = 'en';

    protected $time;

    public function setUp(): void
    {
        date_default_timezone_set('UTC');
        Carbon::setLocale(static::LOCALE);

        // Freeze the time for the test duration
        Carbon::setTestNow(Carbon::now());

        $this->time = Carbon::now()->getTimestamp();
    }
}
