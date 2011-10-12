<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8" />
		<title>MinecraftPHP HTMLog</title>
		<style type="text/css">
			.time, .message {
			    font-family: monospace;
			}
			p {
			    margin: 3px 0;
			}
			.time {
			    color: #AAAAAA;
			}
			table {
			    border-collapse: collapse;
			}
			.systemException td {
			    background-color: rgb(255, 85, 85);
			}
			.systemException td:first-child {
			    border-radius: 10px 0 0 10px;
			}
			.systemException td:last-child {
			    border-radius: 0 10px 10px 0;
			}
		</style>
	</head>
	<body>
		<table>
			<thead>
				<tr>
					<th>Time</th>
					<th>Message</th>
				</tr>
			</thead>
			<tbody>