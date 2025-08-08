import './bootstrap';
import Chart from 'chart.js/auto';

// Listen for MaintenanceReminder events
window.Echo.channel('maintenance-reminders')
    .listen('MaintenanceReminder', (e) => {
        console.log('New Maintenance Reminder received:', e);

        // Update notification badge
        const notificationBadge = document.getElementById('notification-badge');
        if (notificationBadge) {
            let currentCount = parseInt(notificationBadge.textContent) || 0;
            notificationBadge.textContent = currentCount + 1;
            notificationBadge.style.display = 'block'; // Ensure it's visible
        } else {
            // If badge doesn't exist, create it (for initial load or if it was 0)
            const bellIcon = document.querySelector('.fa-bell'); // Assuming bell icon is present
            if (bellIcon) {
                const newBadge = document.createElement('span');
                newBadge.id = 'notification-badge';
                newBadge.className = 'position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger';
                newBadge.textContent = '1';
                bellIcon.parentNode.insertBefore(newBadge, bellIcon.nextSibling);
            }
        }

        // Add new notification to dropdown list
        const notificationList = document.getElementById('notification-dropdown-list');
        if (notificationList) {
            // Remove "Tidak ada notifikasi baru" if it exists
            const noNotificationItem = notificationList.querySelector('li a[href="#"]');
            if (noNotificationItem && noNotificationItem.textContent === 'Tidak ada notifikasi baru') {
                noNotificationItem.parentNode.remove();
            }

            const newNotificationItem = document.createElement('li');
            const notificationLink = document.createElement('a');
            notificationLink.className = 'dropdown-item';
            notificationLink.href = e.url + '?read=' + e.id; // Assuming event data has 'url' and 'id'
            notificationLink.textContent = e.message; // Assuming event data has 'message'

            newNotificationItem.appendChild(notificationLink);
            notificationList.prepend(newNotificationItem); // Add to the top of the list
        }
    });