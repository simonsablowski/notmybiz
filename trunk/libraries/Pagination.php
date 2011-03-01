<?php

class Pagination {
	public static function setup($number, $numberPerPage, $page) {
		return array(
			'first' => (int)$first = 1,
			'last' => (int)$last = ceil($number / $numberPerPage),
			'current' => (int)$current = min(floor($page) >= 1 ? floor($page) : 1, $last),
			'previous' => (int)($current - 1 >= $first ? $current - 1 : $first),
			'next' => (int)($current + 1 <= $last ? $current + 1 : $last),
			'start' => (int)max(($current - 1) * $numberPerPage, 0),
		);
	}
}