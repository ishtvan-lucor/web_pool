<?php
	function ft_is_sort($src) {
		$temp = $src;
		sort($temp);
		if (!array_diff_assoc($src, $temp)) {
			return (TRUE);
		}
		rsort($temp);
		if (!array_diff_assoc($src, $temp)) {
			return (TRUE);
		}
		return (FALSE);
	}