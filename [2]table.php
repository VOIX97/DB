<?php
#$q = isset($_GET["q"]) ? intval($_GET["q"]) : '';
$q = $_GET["q"];
$s = $_GET["s"];
#echo "The s is :".$s.".";
if(empty($q)) {
    echo '请选择一个菌株';
    exit;
}
$con = mysqli_connect('127.0.0.1:3306','root','8204659');
if (!$con)
{
	echo 'can not connect';
    die('Could not connect: ' . mysqli_error($con));
}
// 选择数据库
mysqli_select_db($con,"test");
// 设置编码，防止中文乱码
mysqli_set_charset($con, "utf8");
if ($s!=""){
	$sql="SELECT * FROM final_table1 WHERE ".$s." LIKE '%".$q."%' LIMIT 1000";
}else{
	$sql="SELECT * FROM final_table1 WHERE Rank LIKE '%".$q."%' OR Accession LIKE '%".$q."%' OR Protein_ID LIKE '%".$q."%' OR Protein_Name LIKE '%".$q."%' OR Strains LIKE '%".$q."%' OR Organism LIKE '%".$q."%' OR Description LIKE '%".$q."%' LIMIT 1000";
}
$result = mysqli_query($con,$sql);

echo "<table class='XStb'>
<tr id='tr2' style='background-color #cccccc;'>
<th class='td' id='td1'>Rank</th>
<th class='td' id='td1'>Accession</th>
<th class='td' id='td1'>Protein ID</th>
<th class='td' id='td2'>Protein name</th>
<th class='td' id='td2'>Strains</th>
<th class='td' id='td2'>Organism</th>
<th class='td' id='td1'>Data file</th>
</tr>";
$seq="2";
while($row = mysqli_fetch_array($result))
{
	if ($seq>"1")
	{
		echo "<tr id='tr1' style='background-color: #ffffff;'>";
		echo "<td id='td1'>" . $row['Rank'] . "</td>";
		echo "<td id='td1'>" . $row['Accession'] . "</td>";
		echo "<td id='td1'>" . $row['Protein_ID'] . "</td>";
		echo "<td id='td2'>" . $row['Protein_Name'] . "</td>";
		echo "<td id='td2'>" . $row['Strains'] . "</td>";
		echo "<td id='td2'>" . $row['Organism'] . "</td>";
		echo "<td id='td1'><a href='". $row['Description'] ."'style='color: rgb(0, 12, 255);'>download</a></td>";
		echo "</tr>";
		$seq="0";
	}else
	{
		echo "<tr id='tr2' style='background-color #cccccc;'>";
		echo "<td id='td1'>" . $row['Rank'] . "</td>";
		echo "<td id='td1'>" . $row['Accession'] . "</td>";
		echo "<td id='td1'>" . $row['Protein_ID'] . "</td>";
		echo "<td id='td2'>" . $row['Protein_Name'] . "</td>";
		echo "<td id='td2'>" . $row['Strains'] . "</td>";
		echo "<td id='td2'>" . $row['Organism'] . "</td>";
		echo "<td id='td1'><a href='". $row['Description'] ."'style='color: rgb(0, 12, 255);'>download</a></td>";
		echo "</tr>";
		$seq="2";
	}
}
echo "</table>";

mysqli_close($con);
?>