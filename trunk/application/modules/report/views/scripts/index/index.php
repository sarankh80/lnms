<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	<h2 align="center">Rtp-Client</h2>
	<table width="100%" border="1" style="border-collapse:collapse;" bordercolor="black">
    	<tr​>
        	<th>N<sub>0</sub></th>
            <th>Client N<sub>0</sub></th>
            <th>Name Khmer</th>
            <th>Name Eng</th>
            <th>Sex</th>
            <th>Status</th>
            <th>ID Type</th>
            <th>ID N<sup>0</sup></th>
            <th>Phone</th>
            <th>Village</th>
            <th>Commune</th>
            <th>District</th>
            <th>Province</th>
            <th>Spouse</th>
            <th>House</th>
            <th>Street</th>
        </tr>
      <?php for($i=0;$i<15;$i++){ ?>
      <tr align="center">
        	<td><?php echo $i+1;?></td>
            <td></td>
            <td style="font-family:'Khmer OS Battambang'; font-size:14px;">សេន​​ រដ្ធា</td>
            <td>Sen ratha</td>
            <td>M</td>
            <td>single</td>
            <td></td>
            <td><?php echo $i+1;?></td>
            <td>097 63 62 333</td>
            <td>tangun</td>
            <td>kakap</td>
            <td>Borsen chey</td>
            <td>PP</td>
            <td></td>
            <td>#45</td>
            <td>,1986</td>
        </tr>
        <?php } ?>
       
       
    </table>
</body>
</html>