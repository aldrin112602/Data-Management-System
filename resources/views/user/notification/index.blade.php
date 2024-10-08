@extends('user.layouts.app')

@section('content')
    <div id="notifications-container" class="p-6 space-y-4">
        <!-- Notifications will be populated here -->
    </div>

    <script>
        const userIdentity = JSON.parse(localStorage.getItem('userIdentity'));
        const userId = userIdentity ? userIdentity.uniqueId : null; // Get uniqueId as user_id

        if (userId) {
            axios.get('/user/get_notifications', {
                params: {
                    user_id: userId
                }
            })
            .then(response => {
                const notificationsContainer = document.getElementById('notifications-container');
                response.data.forEach(notification => {
                    // Create notification wrapper
                    const notificationElement = document.createElement('div');
                    notificationElement.classList.add('p-4', 'bg-white', 'rounded-lg', 'shadow-md', 'border', 'border-gray-200', 'space-y-2');
                    
                    // Create title element
                    const titleElement = document.createElement('h2');
                    titleElement.textContent = notification.title; // Assuming there is a title field
                    titleElement.classList.add('text-lg', 'font-bold', 'text-gray-800');
                    
                    // Create message element
                    const messageElement = document.createElement('p');
                    messageElement.textContent = notification.message; // Assuming there is a message field
                    messageElement.classList.add('text-gray-600');
                    
                    // Create date element
                    const dateElement = document.createElement('span');
                    const updatedAt = new Date(notification.updated_at); // Assuming there is an updated_at field
                    dateElement.textContent = `Updated: ${updatedAt.toLocaleDateString()} at ${updatedAt.toLocaleTimeString()}`;
                    dateElement.classList.add('text-sm', 'text-gray-500');

                    // Append title, message, and date to notification element
                    notificationElement.appendChild(titleElement);
                    notificationElement.appendChild(messageElement);
                    notificationElement.appendChild(dateElement);
                    
                    // Append notification element to container
                    notificationsContainer.appendChild(notificationElement);
                });
            })
            .catch(error => {
                console.error('Error fetching notifications:', error);
            });
        } else {
            console.error('User is not authenticated.');
        }
    </script>
@endsection
