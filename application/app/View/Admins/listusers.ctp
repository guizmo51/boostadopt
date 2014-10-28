<table class="table table-bordered table-striped">

<tr>
	<th>ID</th>
	<th>AID</th>
	<th>Token</th>
	<th>Login</th>
	<th>Crédits</th>
	<th>Parrainage key</th>
	<th>Last login</th>
	<th>Service</th>
</tr>
<?php foreach($users as $user) {?>
<tr>
<td><?php echo $user['User']['id'];?></td>
<td><a href="http://www.adopteunmec.com/profile/<?php echo $user['User']['aid'];?>"><?php echo $user['User']['aid'];?></a></td>
<td><?php echo $user['User']['token'];?></td>
<td><a href="/admins/detailuser/<?php echo $user['User']['id'];?>"><?php echo $user['User']['login'];?></a></td>
<td><?php echo $user['User']['credits'];?></td>
<td><?php echo $user['User']['parrainage_key'];?></td>
<td><?php echo $user['User']['last_login'];?></td>
<td><?php echo $user['User']['service'];?></td>
</tr>
<?php }?>
</table>