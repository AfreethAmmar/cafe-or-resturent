<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <style>/* Basic reset and layout */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        
        body {
            background-color: #f4f4f4;
            padding: 20px;
        }
        
        section#orders {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        h2 {
            color: #333;
            margin-bottom: 15px;
        }
        
        .search-container {
            margin-bottom: 20px;
        }
        
        input[type="text"],
        input[type="date"],
        input[type="time"],
        textarea {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        
        textarea {
            resize: vertical;
        }
        
        button {
            background-color: #d4a373;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        
        button:hover {
            background-color: #b38b5f;
        }
        
        select {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        table th,
        table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        table th {
            background-color: #f4f4f4;
        }
        
        table td.actions {
            text-align: center;
        }
        
        table td button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-right: 5px;
        }
        
        table td button:last-child {
            background-color: #f44336;
        }
        
        table td button:hover {
            opacity: 0.8;
        }
        
        form {
            margin-top: 20px;
        }
        </style>
        <body>
        <header>
        <nav>
            <ul>
                
                <li><a href="staff.php">Staff Dashboard</a></li>
                
            </ul>
        </nav>
    </header>
    <section id="orders">
        <h2>Pre-orders</h2>
        <div class="search-container">
            <input type="text" placeholder="Search Orders" id="order-search">
            <select id="ordevaluer-filter">
                <option value="">All</option>
                <option value="new">New</option>
                <option ="confirmed">Confirmed</option>
                <option value="modified">Modified</option>
                <option value="canceled">Canceled</option>
            </select>
        </div>
        <table id="order-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Customer Name</th>
                    <th>Items</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Order rows will be inserted here dynamically -->
            </tbody>
        </table>
        <h2>Place an Order</h2>
        <form id="order-form">
            <label for="order-date">Date:</label>
            <input type="date" id="order-date" name="order-date" required>
            
            <label for="order-time">Time:</label>
            <input type="time" id="order-time" name="order-time" required>
            
            <label for="order-name">Name:</label>
            <input type="text" id="order-name" name="order-name" required>
            
            <label for="order-items">Items:</label>
            <textarea id="order-items" name="order-items" rows="3" required></textarea>
            
            <button type="submit">Place Order</button>
        </form>
    </section>
    <script>// Example data
        const orders = [
            { date: '2024-07-24', time: '19:00', name: 'John Doe', items: 'Pasta, Salad', status: 'new' },
            { date: '2024-07-24', time: '20:00', name: 'Jane Smith', items: 'Pizza, Soda', status: 'confirmed' }
        ];
        
        const notifications = [];
        
        // Render Orders
        function renderOrders(filteredOrders = orders) {
            const tableBody = document.querySelector('#order-table tbody');
            tableBody.innerHTML = '';
            filteredOrders.forEach((order, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${order.date}</td>
                    <td>${order.time}</td>
                    <td>${order.name}</td>
                    <td>${order.items}</td>
                    <td>${order.status}</td>
                    <td class="actions">
                        <button onclick="editOrder(${index})">Edit</button>
                        <button onclick="confirmOrder(${index})">Confirm</button>
                        <button onclick="cancelOrder(${index})">Cancel</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }
        
        // Edit Order
        function editOrder(index) {
            const order = orders[index];
            document.querySelector('#order-date').value = order.date;
            document.querySelector('#order-time').value = order.time;
            document.querySelector('#order-name').value = order.name;
            document.querySelector('#order-items').value = order.items;
            document.querySelector('#order-form').dataset.editIndex = index;
        }
        
        // Confirm Order
        function confirmOrder(index) {
            orders[index].status = 'confirmed';
            renderOrders();
            addNotification('confirmed', Order confirmed for ${orders[index].name});
        }
        
        // Cancel Order
        function cancelOrder(index) {
            orders[index].status = 'canceled';
            renderOrders();
            addNotification('canceled', Order canceled for ${orders[index].name});
        }
        
        // Add Notification
        function addNotification(type, message) {
            const date = new Date().toISOString().split('T')[0];
            notifications.push({ type, message, date });
            alert(message); // Example notification display
        }
        
        // Handle Order Form Submission
        document.querySelector('#order-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const index = this.dataset.editIndex;
            const date = document.querySelector('#order-date').value;
            const time = document.querySelector('#order-time').value;
            const name = document.querySelector('#order-name').value;
            const items = document.querySelector('#order-items').value;
        
            if (index !== undefined) {
                orders[index] = { date, time, name, items, status: 'modified' };
                this.removeAttribute('data-edit-index');
            } else {
                orders.push({ date, time, name, items, status: 'new' });
            }
        
            renderOrders();
            addNotification('info', Order ${index !== undefined ? 'updated' : 'placed'} for ${name});
            this.reset(); // Reset the form
        });
        
        // Handle Search and Filter for Orders
        document.querySelector('#order-search').addEventListener('input', function() {
            const searchText = this.value.toLowerCase();
            const filterValue = document.querySelector('#order-filter').value;
            const filteredOrders = orders.filter(order => {
                const matchesSearch = order.name.toLowerCase().includes(searchText);
                const matchesFilter = filterValue === '' || order.status === filterValue;
                return matchesSearch && matchesFilter;
            });
            renderOrders(filteredOrders);
        });
        
        document.querySelector('#order-filter').addEventListener('change', function() {
            const searchText = document.querySelector('#order-search').value.toLowerCase();
            const filterValue = this.value;
            const filteredOrders = orders.filter(order => {
                const matchesSearch = order.name.toLowerCase().includes(searchText);
                const matchesFilter = filterValue === '' || order.status === filterValue;
                return matchesSearch && matchesFilter;
            });
            renderOrders(filteredOrders);
        });
        
        // Initial Render
        renderOrders();
        </script>
</body>
</html>