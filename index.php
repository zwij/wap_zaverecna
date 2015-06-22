<?php
	include 'zahlavi.php';
	include 'parser.php';
	$addr = "192.168.4.202";
	$defaulturl = "/vorac/ajtaci/vysledek_souteze.php?cislo=";
	$default = array (
		"1",
		"2",
		"8",
		"3",
		"13",
		"11",
		"5",
		"6",
		"7",
		"14",
		"4",
		);
	$titulek = array (
			"Bobřík informatiky-senior",
			"Bobřík informatiky-junior",
			"Domácí kolo MOP",
			"Noc s IT",
			"Olymp IT I",
			"Olymp IT II",
			"SOČ",
			"Soutěž v programování",
			"Soutěž tvorba webu",
			"IT junior",
			"Cisco NetRiders",
		);
	$order = null;

	if(!isset($_GET['order'])) {
		$order = 0;
	} else {
		$order = $_GET['order'];
	}
	$data = parse("http://" . $addr . $defaulturl . $default[$order]);
?>

<h2><?php echo $titulek[$order];?></h2>

<table>
	<tr>
		<th>Pořadí</th>
		<th>Příjmení</th>
		<th>Jméno</th>
		<th>Třída</th>
		<th>Výsledek</th>
		<th>Body</th>
	</tr>
	<?php foreach($data as $v): ?>
		<tr>
			<td><?php echo $v['poradi']; ?></td>
			<td><?php echo $v['prijmeni']; ?></td>
			<td><?php echo $v['jmeno']; ?></td>
			<td><?php echo $v['trida']; ?></td>
			<td><?php echo $v['vysledek']; ?></td>
			<td><?php echo $v['body']; ?></td>
		</tr>
	<?php endforeach; ?>
	<tr><td style="border-width: 0;"><?php 
	if($order == 0){
		echo "<a href='?order=" . ($order + 1) . "'>Next</a></td>";
	}elseif($order != 10){
		echo "<a href='?order=" . ($order - 1) . "'>Prev</a> ";
		echo "<a href='?order=" . ($order + 1) . "'>Next</a></td>";
	}else{
		echo "<a href='?order=" . ($order - 1) . "'>Prev</a></td>";
	}
	?></tr>
</table>
<?php
	include 'zapati.php';
?>