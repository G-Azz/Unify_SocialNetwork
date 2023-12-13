
function closeEditModal() {
    // Assuming you have a modal with an ID 'editModal'
    document.getElementById('editPostModal').style.display = 'none';
    var element = document.getElementById("head");
  element.style.borderColor = '#e6ecf0';
  element.style.background = 'white';
  element.style.color = '#9b1c31';
}
function closeEditModalcomment() {
    // Assuming you have a modal with an ID 'editModal'
    document.getElementById('editPostModalcomment').style.display = 'none';
    var element = document.getElementById("head");
  element.style.borderColor = '#e6ecf0';
  element.style.background = 'white';
  element.style.color = '#9b1c31';
}

function MediaClick(imageUrl) {
    if (imageUrl) {

    imageUrl = decodeURIComponent(imageUrl.replace(/\+/g, ' ')).replace(/&#(\d+);/g, function (match, dec) {
        return String.fromCharCode(dec);})
        document.getElementById('image-preview-container-edit').style.display = 'block';
        document.getElementById('progress-container-edit').style.display = 'block';
        document.getElementById('svg-progress-bar-edit').style.display = 'none';
        
        // Only set the src if it hasn't been set yet
        var imagePreview = document.getElementById('image-preview-edit');
        
            imagePreview.src = imageUrl;
        
    }

}
function showEditModal(postId,Schannel,Stopic,content) {
    document.getElementById('editPostModal').style.display = 'block';
    var element = document.getElementById("head");
    document.getElementById('postId_edit').value = postId;
    document.getElementById('selectedChannel-edit').value = Schannel;
    document.getElementById('selectedTopic-edit').value = Stopic;
    document.getElementById('content-edit').value=content;
    document.querySelector('#hashtag-sign-edit').textContent =Stopic;


    element.style.borderColor = '#8A8E90';
    element.style.background = 'rgba(153,153,153,1)';
    element.style.color = '#5B111D';
    document.querySelector('.dropdown-menu-post__content').style.display = 'none';
    document.querySelector('.dropdown-menu-post__icon').classList.toggle('active');
    
  }
  function showEditModalcomment(commentId,content) {
    document.getElementById('editPostModalcomment').style.display = 'block';
    var element = document.getElementById("head");
    document.getElementById('commentId_edit').value = commentId;
    document.getElementById('content-editcomment').value=content;
    element.style.borderColor = '#8A8E90';
    element.style.background = 'rgba(153,153,153,1)';
    element.style.color = '#5B111D';
    document.querySelector('.dropdown-menu-post__content').style.display = 'none';
    document.querySelector('.dropdown-menu-post__icon').classList.toggle('active');
    
  }
  


document.addEventListener("DOMContentLoaded", function () {
    const removeImageButton = document.getElementById('remove-image-btn-edit');
    const imagePreviewContainer = document.getElementById('image-preview-container-edit');
    const fileUploadInput = document.getElementById('file-upload-edit');
    var dropbtn = document.getElementById('dropbtn-edit');
    var dropdownContent = document.getElementById('dropdown-content-edit');
    var selectedOptionsContainer = document.getElementById('selected-options-edit');
    var selectedOptions = new Set(); // Use a Set to store unique values
    var dropbtn2 = document.getElementById('dropbtn2-edit');
    var dropdownContent2 = document.getElementById('dropdown-content2-edit');
    var hashtagSign = document.getElementById('hashtag-sign-edit');
    var selectedChannels = [];
  
   

    removeImageButton.addEventListener('click', function () {
        // Hide the image preview container
        imagePreviewContainer.style.display = 'none';
        // Remove the src from the image to release the object URL if it was used
        const imagePreview = document.getElementById('image-preview-edit');
        if (imagePreview.src) {
            URL.revokeObjectURL(imagePreview.src);
            imagePreview.src = '';
        }
        // Clear the value of the file input
        fileUploadInput.value = '';
        // Update the button state
        if (document.getElementById("postContent-edit").value == "")
            toggleUploadButton(fileUploadInput);
    });


function updateSelectedOptionsDisplayedit() {
        selectedOptionsContainer.innerHTML = ''; // Clear current content

        // Define the order of the tags
        const orderedOptions = ['General_Chat', 'Area_Chat', 'University_Chat', 'Class_Chat', 'Private_Chat'];

        // Function to remove a tag
        function removeTag(option) {
            selectedOptions.delete(option);
            updateSelectedOptionsDisplayedit();
        }

        // Function to remove all tags
        function removeAllTags() {
            selectedOptions.clear();
            updateSelectedOptionsDisplayedit();
        }

        // Update visual state of dropdown items
        document.querySelectorAll('#dropdown-content-edit a').forEach(a => {
            if (selectedOptions.has(a.getAttribute('data-value'))) {
                a.classList.add('selected'); // Add 'selected' class
            } else {
                a.classList.remove('selected'); // Remove 'selected' class
            }
        });

        // Check if 'All Channels' is selected or all individual channels are selected
        if (selectedOptions.has('All_Channels') || selectedOptions.size === orderedOptions.length) {
            const tag = document.createElement('span');
            tag.className = 'tag';
            tag.textContent = 'All Channels';

            // Create the remove button for 'All Channels'
            const removeAllBtn = document.createElement('span');
            removeAllBtn.className = 'remove-btn';
            removeAllBtn.onclick = removeAllTags;
            tag.appendChild(removeAllBtn);

            selectedOptionsContainer.appendChild(tag);
        } else {
            // Add tags based on the predefined order
            orderedOptions.forEach(option => {
                if (selectedOptions.has(option)) {
                    const tag = document.createElement('span');
                    tag.className = 'tag';
                    tag.textContent = option.replace('_', ' '); // Replace underscores with spaces for display

                    // Create the remove button for individual tags
                    const removeBtn = document.createElement('span');
                    removeBtn.className = 'remove-btn';
                    removeBtn.onclick = () => removeTag(option);
                    tag.appendChild(removeBtn);

                    selectedOptionsContainer.appendChild(tag);
                }
            });
        }
    }



    // Assuming selectedChannels is declared and initialized elsewhere
    // var selectedChannels = [...];
    document.querySelector('#dropdown-content2-edit').addEventListener('click', function (e) {
        e.preventDefault();

        var topicValue = e.target.getAttribute('data-value');
        document.querySelector('#selectedTopic-edit').value = topicValue;

        // Update the visual display of the selected topic
        document.querySelector('#hashtag-sign-edit').textContent = topicValue;
    });
    const allChannels = ['General_Chat', 'Area_Chat', 'University_Chat', 'Class_Chat', 'Private_Chat'];

    document.querySelector('#dropdown-content-edit').addEventListener('click', function (e) {
        e.preventDefault(); // Prevent the default link behavior

        var channelValue = e.target.getAttribute('data-value');

        if (channelValue === 'All_Channels') {
            // Check if 'All Channels' is already selected by checking its class
            if (e.target.classList.contains('selected')) {
                // If 'All Channels' is unselected, empty the selectedChannels array
                selectedChannels = [];
                // Update visual state for all items (remove 'selected' class)
                document.querySelectorAll('#dropdown-content-edit [data-value]').forEach(item => {
                    item.classList.remove('selected');
                });
            } else {
                // If 'All Channels' is selected, set to all predefined channels
                selectedChannels = [...allChannels];
                // Update visual state for all items (add 'selected' class)
                document.querySelectorAll('#dropdown-content-edit [data-value]').forEach(item => {
                    item.classList.add('selected');
                });
            }
        } else {
            // Handle individual channel selection
            if (!selectedChannels.includes(channelValue)) {
                // If not selected, add to the array
                selectedChannels.push(channelValue);
                // Update visual state (add 'selected' class)
                e.target.classList.add('selected');
            } else {
                // If already selected, remove from the array
                selectedChannels = selectedChannels.filter(ch => ch !== channelValue);
                // Update visual state (remove 'selected' class)
                e.target.classList.remove('selected');
            }

            // Reorder the selectedChannels array to match the predefined order
            selectedChannels = allChannels.filter(ch => selectedChannels.includes(ch));
        }

        // Toggle the 'selected' class for 'All Channels' if necessary
        if (channelValue === 'All_Channels') {
            e.target.classList.toggle('selected');
        }

        // Log the selected channels for debugging
        console.log(selectedChannels.join(','));

        // Update the value of the hidden input field
        document.querySelector('#selectedChannel-edit').value = selectedChannels.join(',');
        console.log(document.querySelector('#selectedChannel-edit').value);
    });




    dropbtn2.addEventListener('click', function () {
        dropdownContent2.style.display = dropdownContent2.style.display === 'block' ? 'none' : 'block';
    });

    dropdownContent2.addEventListener('click', function (e) {
        e.preventDefault();
        var option = e.target.getAttribute('data-value');
        hashtagSign.textContent = option; // Change the text of #topic to the selected option
        dropdownContent2.style.display = 'none'; // Close the dropdown
    });

    // Close the dropdown when clicking outside
    window.addEventListener('click', function (e) {
        if (!dropbtn2.contains(e.target) && !dropdownContent2.contains(e.target)) {
            dropdownContent2.style.display = 'none';
        }
    });

    function updateSelectedOptionsDisplayedit() {
        selectedOptionsContainer.innerHTML = ''; // Clear current content

        // Define the order of the tags
        const orderedOptions = ['General_Chat', 'Area_Chat', 'University_Chat', 'Class_Chat', 'Private_Chat'];

        // Function to remove a tag
        function removeTag(option) {
            selectedOptions.delete(option);
            updateSelectedOptionsDisplayedit();
        }

        // Function to remove all tags
        function removeAllTags() {
            selectedOptions.clear();
            updateSelectedOptionsDisplayedit();
        }

        // Update visual state of dropdown items
        document.querySelectorAll('#dropdown-content-edit a').forEach(a => {
            if (selectedOptions.has(a.getAttribute('data-value'))) {
                a.classList.add('selected'); // Add 'selected' class
            } else {
                a.classList.remove('selected'); // Remove 'selected' class
            }
        });

        // Check if 'All Channels' is selected or all individual channels are selected
        if (selectedOptions.has('All_Channels') || selectedOptions.size === orderedOptions.length) {
            const tag = document.createElement('span');
            tag.className = 'tag';
            tag.textContent = 'All Channels';

            // Create the remove button for 'All Channels'
            const removeAllBtn = document.createElement('span');
            removeAllBtn.className = 'remove-btn';
            removeAllBtn.onclick = removeAllTags;
            tag.appendChild(removeAllBtn);

            selectedOptionsContainer.appendChild(tag);
        } else {
            // Add tags based on the predefined order
            orderedOptions.forEach(option => {
                if (selectedOptions.has(option)) {
                    const tag = document.createElement('span');
                    tag.className = 'tag';
                    tag.textContent = option.replace('_', ' '); // Replace underscores with spaces for display

                    // Create the remove button for individual tags
                    const removeBtn = document.createElement('span');
                    removeBtn.className = 'remove-btn';
                    removeBtn.onclick = () => removeTag(option);
                    tag.appendChild(removeBtn);

                    selectedOptionsContainer.appendChild(tag);
                }
            });
        }
    }

    // Toggle the dropdown display
    dropbtn.addEventListener('click', function () {
        console.log("hi");
        dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
    });

    // Handle option selection
    dropdownContent.addEventListener('click', function (e) {
        e.preventDefault();
        var option = e.target.getAttribute('data-value');

        // Toggle the selection for "All Channels"
        if (option === 'All_Channels') {
            if (selectedOptions.has(option)) {
                selectedOptions.clear();
            } else {
                selectedOptions.clear();
                Array.from(dropdownContent.querySelectorAll('a')).forEach(a => {
                    selectedOptions.add(a.getAttribute('data-value'));
                });
            }
        } else {
            // Toggle individual options
            if (selectedOptions.has(option)) {
                selectedOptions.delete(option);
                selectedOptions.delete('All_Channels'); // Deselect "All Channels" if an individual option is deselected
            } else {
                selectedOptions.add(option);
                // Check if all other options are selected

                if (selectedOptions.size === dropdownContent.querySelectorAll('a').length - 1) {
                    selectedOptions.add('All_Channels');
                }
            }
        }

        updateSelectedOptionsDisplayedit();
    });

    // Close the dropdown when clicking outside
    window.addEventListener('click', function (e) {
        if (!dropbtn.contains(e.target) && !dropdownContent.contains(e.target)) {
            dropdownContent.style.display = 'none';
        }
    });

    // Call the function when the page loads
    updateSelectedOptionsDisplayedit();

    document.getElementById('file-upload-edit').addEventListener('change', function (event) {
        console.log("File selected");
        var file = event.target.files[0]; // Get the selected file
        console.log(file); // Logging the file object
    
        var reader = new FileReader();
    
        reader.onload = function (e) {
            console.log("File read");
            // Set the src of the image preview to the read file data
            document.getElementById('image-preview-edit').src = e.target.result;
    
            // Display the image preview container
            document.getElementById('image-preview-container-edit').style.display = 'block';
    
            // Display the progress container (if this is supposed to be visible during upload)
            document.getElementById('progress-container-edit').style.display = 'block';
    
            // Call function to handle the file upload
            uploadFileedit(file); 
        };
    
        // Read the file as a Data URL (base64 encoded string of the file data)
        reader.readAsDataURL(file);
    });
    

    function uploadFileedit(file) {
        var xhr = new XMLHttpRequest();
        var formData = new FormData();
        formData.append('file', file);

        xhr.upload.onprogress = function (event) {
            if (event.lengthComputable) {
                var percentComplete = (event.loaded / event.total) * 100;
                setProgressedit(percentComplete);
            }
        };

        xhr.open('POST', '/Unify_SocialNetwork/View/FrontOffice/Home/postDedit.php', true); // Replace '/upload-url' with your upload endpoint
        xhr.send(formData);

        xhr.onload = function () {
            if (xhr.status === 200) {
                console.log("Upload complete");
                // Hide the progress bar
                document.getElementById('svg-progress-bar-edit').style.display = 'none';
            } else {
                console.log("Upload error: " + xhr.status);
                // Handle error here
            }
        };
    }

    function setProgressedit(percent) {
        var progressBar = document.getElementById('progress-bar-edit');
        var circumference = 2 * Math.PI * 45; // Circumference of the circle
        var offset = circumference - (percent / 100) * circumference;
        progressBar.setAttribute('stroke-dashoffset', offset);
    }


    
  
    

});
function initializeEditModal(initialSelectedChannels) {
    // Clear the current selections and UI
    var selectedOptionsContainer = document.getElementById('selected-options-edit');
    var selectedOptions = new Set(); // Use a Set to store unique values
    selectedOptions.clear();
    selectedOptionsContainer.innerHTML = '';

    // Add the initial channels to the selectedOptions Set
    initialSelectedChannels.forEach(function(channel) {
        selectedOptions.add(channel);

        // Find the corresponding dropdown item and mark it as selected
        var item = document.querySelector('#dropdown-content-edit [data-value="' + channel + '"]');
        if (item) {
            item.classList.add('selected');
        }

        // Create and append tags for the selected options
        const tag = document.createElement('span');
        tag.className = 'tag';
        tag.textContent = channel.replace('_', ' '); // Replace underscores with spaces for display

        // Optionally, add a remove button to each tag
        const removeBtn = document.createElement('span');
        removeBtn.className = 'remove-btn';
        removeBtn.onclick = function() {
            selectedOptions.delete(channel);
            updateSelectedOptionsDisplayedit(); // Call to update UI after removing an option
        };
        tag.appendChild(removeBtn);

        selectedOptionsContainer.appendChild(tag);
    });

    // Set the value of the hidden input field
    document.querySelector('#selectedChannel-edit').value = initialSelectedChannels.join(',');
}


function handleClickModalEdit(element) {
    var postId = element.getAttribute('data-post-id');
    var channelId = element.getAttribute('data-channel-id');
    var posttypeId = element.getAttribute('data-posttype-id');
    var content = element.getAttribute('data-content');
    var media = element.getAttribute('data-media');
    var initialSelectedChannels = channelId.split(',');

    showEditModal(postId, channelId, posttypeId, content);
    if (media) {
        MediaClick(media);
    }
    initializeEditModal(initialSelectedChannels);
}
function handleClickModalEditcomment(element) {
    var commentId = element.getAttribute('data-comment-id');
    var content = element.getAttribute('data-content-comment');

    showEditModalcomment(commentId,content);

}

