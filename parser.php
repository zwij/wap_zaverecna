<?php

function parse($url) {
	
	$contents = file_get_contents($url);

	$table = preg_match_all("~<tr>"
		."<td align='center' class='tbl[12]{1}'>(.+?)</td>"
		."<td class='tbl[12]{1}'>(.+?)</span></td>"
		."<td class='tbl[12]{1}'>(.+?)</span></td>"
		."<td class='tbl[12]{1}'>(.+?)</span></td>"
		."<td class='tbl[12]{1}'  align='center'>(.*?)</span></td>"
		."<td align='center' class='tbl[12]{1}'>(.+?)</span></td>"
		."</td></tr>"
		."~", $contents, $matches, PREG_SET_ORDER);

	$out = array();

	for($i = 0; $i < (count($matches) < 3 ? count($matches) : 3); $i++) {
		$user = $matches[$i];
		$out[] = array(
				"jmeno" => $user[3],
				"prijmeni" => $user[2],
				"trida" => $user[4],
				"poradi" => $user[1],
				"vysledek" => $user[5],
				"body" => $user[6]
			);
	}

	return $out;
}