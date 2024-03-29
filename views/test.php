<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<h2>HTML Table</h2>

<table>
  <tr>
    <th>Company</th>
    <th>Contact</th>
    <th>Country</th>
  </tr>
  <?php
    foreach($data['companies'] as $company) {
      echo "
        <tr>
          <td>{$company['name']}</td>
          <td>{$company['contact']}</td>
          <td>{$company['country']}</td>
        </tr>
      ";
    }
  ?>
</table>

</body>
</html>
