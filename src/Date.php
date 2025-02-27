<?php declare(strict_types=1);

namespace Jenssegers\Date;

use Carbon\Carbon;
use Carbon\WeekDay;
use Carbon\Month;
use DateTimeInterface;
use DateTimeZone;

class Date extends Carbon
{
	/**
	 * Function to call instead of format.
	 *
	 * @var string|callable|null
	 */
	protected static $formatFunction = 'translatedFormat';

	/**
	 * Function to call instead of createFromFormat.
	 * 
	 * @var string|callable|null
	 */
	protected static $createFromFormatFunction = 'createFromFormatWithCurrentLocale';

	/**
	 * Function to call instead of parse.
	 * 
	 * @var string|callable|null
	 */
	protected static $parseFunction = 'parseWithCurrentLocale';

	public static function parseWithCurrentLocale(DateTimeInterface | WeekDay | Month | string | int | float | null $time = null, DateTimeZone | string | int | null $timezone = null): static
	{
		if (is_string($time)) {
			$time = static::translateTimeString(timeString: $time, from: static::getLocale(), to: 'en');
		}

		return parent::rawParse(time: $time, timezone: $timezone);
	}

	public static function createFromFormatWithCurrentLocale(string $format, string $time, DateTimeZone | string | int | null $timezone = null): static
	{
		$time = static::translateTimeString(timeString: $time, from: static::getLocale(), to: 'en');

		return parent::rawCreateFromFormat(format: $format, time: $time, timezone: $timezone);
	}

	/**
	 * Get the language portion of the locale.
	 */
	public static function getLanguageFromLocale(string $locale): string
	{
		$parts = explode('_', str_replace('-', '_', $locale));

		return $parts[0];
	}
}
