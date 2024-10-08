
@extends('user.layouts.app')

@section('content')
<h1>User Dashboard - Map View</h1>

<div id="map" class="w-full h-screen"></div>

<!-- Identity Modal -->
<div id="identityModal" class="hidden fixed z-50 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-lg">
            <!-- Modal Header -->
            <div class="flex justify-between items-center p-4 border-b">
                <h2 class="text-xl font-semibold">Set Your Identity</h2>
                <button class="text-gray-500 hover:text-gray-700" onclick="closeIdentityModal()">✖</button>
            </div>

            <!-- Modal Body -->
            <div class="p-4">
                <form id="identityForm" enctype="multipart/form-data"> <!-- Add enctype for file uploads -->
                    <!-- Complete Name -->
                    <div class="my-4">
                        <label for="userName" class="block text-lg font-medium text-gray-700">Complete Name</label>
                        <input type="text" id="userName" name="userName" class="w-full p-3 mt-2 border rounded-lg" required>
                    </div>

                    <!-- Address -->
                    <div class="my-4">
                        <label for="address" class="block text-lg font-medium text-gray-700">Address</label>
                        <input type="text" id="address" name="address" class="w-full p-3 mt-2 border rounded-lg" required>
                    </div>

                    <!-- Gender (Male or Female) -->
                    <div class="my-4">
                        <label for="gender" class="block text-lg font-medium text-gray-700">Gender</label>
                        <select id="gender" name="gender" class="w-full p-3 mt-2 border rounded-lg" required>
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>

                    <!-- Age -->
                    <div class="my-4">
                        <label for="age" class="block text-lg font-medium text-gray-700">Age</label>
                        <input type="number" id="age" name="age" class="w-full p-3 mt-2 border rounded-lg" required min="1">
                    </div>

                    <!-- Tourist or Town Resident -->
                    <div class="my-4">
                        <label for="status_type" class="block text-lg font-medium text-gray-700">Are you a Tourist or Town Resident?</label>
                        <select id="status_type" name="status_type" class="w-full p-3 mt-2 border rounded-lg" required>
                            <option value="">Select Status</option>
                            <option value="tourist">Tourist</option>
                            <option value="town_resident">Town Resident</option>
                        </select>
                    </div>

                    <!-- Save Button -->
                    <button type="button" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg shadow" onclick="saveIdentity()">Save Identity</button>
                </form>
            </div>



        </div>
    </div>
</div>

<!-- Review Modal -->
<div id="reviewModal" class="hidden fixed z-50 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl overflow-y-auto max-h-screen">
            <!-- Modal Header -->
            <div class="flex justify-between items-center p-4 border-b">
                <h2 id="modalTitle" class="text-xl font-semibold">Reviews</h2>
                <button class="text-gray-500 hover:text-gray-700" onclick="closeModal()">✖</button>
            </div>

            <!-- Modal Body -->
            <div class="p-4">
                <!-- Location Image -->
                <div id="modalImageContainer" class="mb-4">
                    <img id="modalImage" src="" alt="" class="w-full h-64 object-cover rounded-lg shadow-lg">
                </div>

                <!-- Reviews Section -->
                <div id="reviewContent" class="space-y-4 mb-6">
                    <!-- Existing Reviews will be injected here dynamically -->
                </div>



                <!-- Review Form -->
                <div id="addReviewForm" class="mt-6">
                    <!-- Star Rating System -->
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold text-gray-700">Rate this location</h3>
                        <div id="starRating" class="flex space-x-2 mt-2">
                            @for($i = 1; $i <= 5; $i++)
                                <span data-value="{{ $i }}" class="star text-gray-400 cursor-pointer text-2xl">★</span>
                                @endfor
                        </div>
                    </div>

                    <h4 class="text-lg font-semibold text-gray-700">Add/Edit Your Review</h4>
                    <form id="reviewForm" enctype="multipart/form-data">
                        <textarea id="reviewText" class="w-full p-3 border rounded-lg mt-3 text-gray-700" rows="3" placeholder="Write your review..."></textarea>
                        <input type="hidden" id="selectedRating" value="0" />
                        <input type="hidden" id="userIdentity" value="" />
                        <input type="hidden" id="reviewId" value="" /> <!-- To identify if it's an edit -->

                        <!-- Media File Input -->
                        <div class="my-4">
                            <label for="media_file" class="block text-lg font-medium text-gray-700">Upload Media File</label>
                            <input type="file" id="media_file" name="media_file" class="w-full p-3 mt-2 border rounded-lg" accept="image/*,video/*">
                        </div>

                        <!-- Submit/Update Button -->
                        <button type="button" id="submitReviewBtn" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg shadow" onclick="submitOrUpdateReview()">Submit Review</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css" rel="stylesheet" />

<script>
    'use strict';

    mapboxgl.accessToken = 'pk.eyJ1Ijoicm9uZWwtNjY2IiwiYSI6ImNsanY5bmZuNDBvNWcza21oeGtoYjRudjUifQ.SY_2i8fuKAAaj6aApGbNpw';

    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [121.493735, 16.600410],
        zoom: 12
    });

    map.addControl(new mapboxgl.NavigationControl());

    const locations = @json($locations);
    let currentLocationId = null;
    let addReviewForm = document.querySelector('#addReviewForm');

    const userSession = JSON.parse(localStorage.getItem('userIdentity'));

    function openReviewModal(location) {
        location = JSON.parse(atob(location));
        currentLocationId = location.id;

        // Check if identity is set in session (simulated with localStorage here)
        const identity = localStorage.getItem('userIdentity');

        if (!identity) {
            openIdentityModal();
            return;
        }

        document.getElementById('reviewModal').classList.remove('hidden');
        const modalTitle = document.getElementById('modalTitle');
        const modalImage = document.getElementById('modalImage');

        modalTitle.textContent = `Reviews for ${location.location_name}`;
        modalImage.src = `/storage/${location.image}`;
        modalImage.alt = `${location.location_name}`;

        document.getElementById('reviewText').value = '';
        document.getElementById('selectedRating').value = 0;
        document.getElementById('userIdentity').value = identity;

+

        axios.get("{{ route('user.get_reviews') }}", {
                params: {
                    location_id: currentLocationId
                }
            })
            .then(response => {
                const reviews = response.data;
                const reviewContent = document.getElementById('reviewContent');
                reviewContent.innerHTML = '';

                if (reviews.length > 0) {
                    addReviewForm.style.display = 'none';
                    reviews.forEach(review => {
                        // Create a div for each review
                        const reviewElement = document.createElement('div');
                        reviewElement.classList.add('bg-white', 'shadow-md', 'rounded-lg', 'p-4', 'space-y-2', 'border');

                        // Add review content (name, text, rating, etc.)
                        reviewElement.innerHTML = `
                <div class="flex items-center justify-between">
                        <h1 class="font-semibold text-lg">${review.user_name}</h1>
                        <div class="${userSession.uniqueId != review.user_unique_id ? 'hidden': ''}">
                            <button>Edit</button>
                            <button>Delete</button>
                        </div>
                </div>
                <div class="text-gray-500">${review.address}, ${review.gender}, ${review.age} years old</div>
                <div class="text-yellow-500">Rating: ${review.rating}/5</div>
                <div class="text-gray-700">${review.review_text}</div>
                <div class="text-xs text-gray-400">Updated on: ${new Date(review.updated_at).toLocaleDateString()}</div>
            `;

                        // If there's a media file (image or video), append it
                        if (review.media_file) {
                            const mediaElement = document.createElement('div');
                            if (/\.(jpeg|jpg|png|gif)$/i.test(review.media_file)) {
                                mediaElement.innerHTML = `<img src="${review.media_file}" alt="Review media" class="w-20 h-20 object-cover">`;
                            } else if (/\.(mp4|webm|ogg)$/i.test(review.media_file)) {
                                mediaElement.innerHTML = `<video src="${review.media_file}" class="w-20" controls></video>`;
                            }
                            reviewElement.appendChild(mediaElement);
                        }

                        // Append the review element to the content container
                        reviewContent.appendChild(reviewElement);
                    });
                } else {
                    // If no reviews are found
                    reviewContent.innerHTML = '<p class="text-gray-500">No reviews found for this location.</p>';
                    addReviewForm.style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Error fetching reviews:', error);
            });



        resetStarRating();
    }

    function closeModal() {
        document.getElementById('reviewModal').classList.add('hidden');
    }

    function resetStarRating() {
        document.querySelectorAll('.star').forEach(star => {
            star.classList.remove('text-yellow-500');
            star.classList.add('text-gray-400');
        });
    }

    function updateStarRating(rating) {
        document.querySelectorAll('.star').forEach(star => {
            star.classList.remove('text-yellow-500');
            star.classList.add('text-gray-400');
            if (star.getAttribute('data-value') <= rating) {
                star.classList.add('text-yellow-500');
                star.classList.remove('text-gray-400');
            }
        });
    }

    document.querySelectorAll('.star').forEach(star => {
        star.addEventListener('click', function() {
            const rating = this.getAttribute('data-value');
            document.getElementById('selectedRating').value = rating;
            updateStarRating(rating);
        });
    });

    function submitReview() {
        const reviewText = document.getElementById('reviewText').value;
        const selectedRating = document.getElementById('selectedRating').value;
        const userIdentity = document.getElementById('userIdentity').value;
        const mediaFile = document.getElementById('media_file').files[0]; // Get the selected file

        if (!reviewText.trim()) {
            alert('Please write a review.');
            return;
        }

        if (selectedRating == 0) {
            alert('Please select a star rating.');
            return;
        }



        const reviewData = new FormData();
        reviewData.append('review_text', reviewText);
        reviewData.append('rating', selectedRating);
        reviewData.append('user_name', userSession ? userSession.userName : null);
        reviewData.append('address', userSession ? userSession.address : null);
        reviewData.append('gender', userSession ? userSession.gender : null);
        reviewData.append('age', userSession ? userSession.age : null);
        reviewData.append('status_type', userSession ? userSession.status_type : null);
        reviewData.append('status', userSession ? userSession.status : null);
        reviewData.append('location_id', currentLocationId);
        reviewData.append('user_unique_id', userSession ? userSession.uniqueId : null);

        if (mediaFile) {
            reviewData.append('media_file', mediaFile);
        }

        axios.post("/user/dashboard", reviewData, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(res => {
                console.log(res.data);
                alert('Review submitted successfully!');
                closeModal();
            })
            .catch(err => {
                console.log(err);
                alert('Error submitting review');
            });
    }


    function openIdentityModal() {
        document.getElementById('identityModal').classList.remove('hidden');
    }

    function closeIdentityModal() {
        document.getElementById('identityModal').classList.add('hidden');
    }

    function saveIdentity() {
        const userName = document.getElementById('userName').value;
        const address = document.getElementById('address').value;
        const gender = document.getElementById('gender').value;
        const age = document.getElementById('age').value;
        const status_type = document.getElementById('status_type').value;

        // Validation checks
        if (!userName.trim()) {
            alert('Please enter a valid name or identifier.');
            return;
        }
        if (!address.trim()) {
            alert('Please enter a valid address.');
            return;
        }
        if (!gender) {
            alert('Please select a gender.');
            return;
        }
        if (!age || age < 1) {
            alert('Please enter a valid age.');
            return;
        }
        if (!status_type) {
            alert('Please select your status (Tourist or Town Resident).');
            return;
        }

        // Simulate saving identity to session by using localStorage
        let uniqueId = Date.now() + '-' + Math.floor(Math.random() * 10000);
        const userIdentity = {
            userName: userName,
            address: address,
            gender: gender,
            status_type: status_type,
            age: age,
            uniqueId: uniqueId
        };

        localStorage.setItem('userIdentity', JSON.stringify(userIdentity));

        // Close the modal after saving
        closeIdentityModal();

        alert('Your identity has been saved. You can now add reviews.');
    }



    // Loop through each location and add a marker
    locations.forEach(function(location) {
        const el = document.createElement('div');
        el.className = 'custom-marker';
        el.style.backgroundImage = `url('/storage/${location.image}')`;
        el.style.width = '50px';
        el.style.height = '50px';
        el.style.backgroundSize = '100%';
        el.style.borderRadius = '50%';
        el.style.cursor = 'pointer';

        const marker = new mapboxgl.Marker(el)
            .setLngLat([location.longitude, location.latitude])
            .addTo(map);

        // Create a popup with location information
        const popup = new mapboxgl.Popup({
                offset: 25
            })
            .setHTML(`
                <div class="p-4 max-w-xs bg-white rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold text-gray-800">${location.location_name}</h3>
                    <p class="text-sm text-gray-600 mt-2">${location.description}</p>
                    <button onclick="openReviewModal('${btoa(JSON.stringify(location))}')" class="mt-3 inline-block text-blue-500 hover:underline">View Details</button>
                </div>
            `);

        marker.setPopup(popup);
    });
</script>
@endsection