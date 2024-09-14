<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }
        h2 {
            border-bottom: 2px solid #d4a373;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .search-container {
            margin-bottom: 20px;
        }
        .search-container input, .search-container select {
            padding: 8px;
            margin-right: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        .actions button {
            margin-right: 5px;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #d4a373;
            color: #fff;
        }
        .actions button:hover {
            background-color: #c2905e;
        }
        form {
            max-width: 500px;
            margin-bottom: 20px;
        }
        form label {
            display: block;
            margin-bottom: 5px;
        }
        form input, form select, form button {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        form button {
            background-color: #d4a373;
            color: #fff;
            border: none;
        }
        form button:hover {
            background-color: #c2905e;
        }
        .notification {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            color: #fff;
        }
        .notification.success {
            background-color: #4CAF50;
        }
        .notification.error {
            background-color: #f44336;
        }
    </style>
</head>
<body>
<header>
        <nav>
            <ul>
                
                <li><a href="staff.php">Staff Dashboard</a></li>
                
            </ul>
        </nav>
    </header>
    <section id="reservations">
        <h2>Reservations</h2>
        <div class="search-container">
            <input type="text" placeholder="Search Reservations" id="reservation-search">
            <select id="reservation-filter">
                <option value="">All</option>
                <option value="new">New</option>
                <option value="confirmed">Confirmed</option>
                <option value="modified">Modified</option>
                <option value="canceled">Canceled</option>
            </select>
        </div>
        <table id="reservation-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Customer Name</th>
                    <th>Table</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Reservation rows will be inserted here dynamically -->
            </tbody>
        </table>
        <h2>Make a Reservation</h2>
        <form id="reservation-form">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>
            
            <label for="time">Time:</label>
            <input type="time" id="time" name="time" required>
            
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="table">Table:</label>
            <select id="table" name="table" required>
              <option value="Table 1">Table 1</option>
              <option value="Table 2">Table 2</option>
              <option value="Table 3">Table 3</option>
              <option value="Table 4">Table 4</option>
              <option value="Table 5">Table 5</option>
            </select>
            
            <button type="submit">Reserve Table</button>
        </form>
        <div id="notification-container"></div>
    </section>
    <script>
        // Example data
        let reservations = [
            { date: '2024-07-24', time: '19:00', name: 'John Doe', table: 'Table 1', status: 'new' },
            { date: '2024-07-24', time: '20:00', name: 'Jane Smith', table: 'Table 2', status: 'confirmed' }
        ];

        // Render Reservations
        function renderReservations(filteredReservations = reservations) {
            const tableBody = document.querySelector('#reservation-table tbody');
            tableBody.innerHTML = '';
            filteredReservations.forEach((reservation, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${reservation.date}</td>
                    <td>${reservation.time}</td>
                    <td>${reservation.name}</td>
                    <td>${reservation.table}</td>
                    <td>${reservation.status}</td>
                    <td class="actions">
                        <button onclick="confirmReservation(${index})">Confirm</button>
                        <button onclick="editReservation(${index})">Edit</button>
                        <button onclick="cancelReservation(${index})">Cancel</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        // Filter Reservations
        document.querySelector('#reservation-filter').addEventListener('change', function() {
            const filter = this.value;
            const filteredReservations = reservations.filter(reservation => filter === '' || reservation.status === filter);
            renderReservations(filteredReservations);
        });

        // Search Reservations
        document.querySelector('#reservation-search').addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const filteredReservations = reservations.filter(reservation => reservation.name.toLowerCase().includes(query));
            renderReservations(filteredReservations);
        });

        // Add Reservation
        document.querySelector('#reservation-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const date = document.querySelector('#date').value;
            const time = document.querySelector('#time').value;
            const name = document.querySelector('#name').value;
            const table = document.querySelector('#table').value;

            reservations.push({ date, time, name, table, status: 'new' });
            renderReservations();
            this.reset();
            showNotification('Reservation added successfully!', 'success');
        });

        // Confirm Reservation
        function confirmReservation(index) {
            reservations[index].status = 'confirmed';
            renderReservations();
            showNotification('Reservation confirmed successfully!', 'success');
        }

        // Edit Reservation
        function editReservation(index) {
            const reservation = reservations[index];
            const newName = prompt('Edit Reservation Name:', reservation.name);
            if (newName) {
                reservation.name = newName;
                reservation.status = 'modified';
                renderReservations();
                showNotification('Reservation modified successfully!', 'success');
            }
        }

        // Cancel Reservation
        function cancelReservation(index) {
            if (confirm('Are you sure you want to cancel this reservation?')) {
                reservations[index].status = 'canceled';
                renderReservations();
                showNotification('Reservation canceled successfully!', 'error');
            }
        }

        // Show Notification
        function showNotification(message, type) {
            const notificationContainer = document.getElementById('notification-container');
            const notification = document.createElement('div');
            notification.className = notification ${type};
            notification.textContent = message;
            notificationContainer.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Initial Render
        renderReservations();
    </script>
</body>
</html>