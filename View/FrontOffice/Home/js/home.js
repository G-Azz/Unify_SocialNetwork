function toggleGiphyMenu(icon,type) {
  var menu = icon.parentNode.querySelector('.giphy-menu');
  if (menu.style.display === 'none') {
    menu.style.display = 'block';
    searchGiphy(menu,type); // Call this function to populate the menu with GIFs
  } 

 
 
} 
function toggleEmoteMenu(icon,type) {
  var menu = icon.parentNode.querySelector('.emote-container');
  console.log(icon.parentNode.querySelector('.emote-container')); // Find the .emote-container element next to the clicked icon
  if (menu.style.display === 'none' || menu.style.display === '') {
    menu.style.display = 'block';
    fetchAndDisplayEmotes(menu,type); // Call this function to populate the menu with GIFs
  } else {
    menu.style.display = 'none';
  }
}



function searchGiphy(menu, type) {
  var apiKey = 'QZeoMHsSrsf05dWvkJJAaEp8ch5HvaYy'; // Your Giphy API key

  // Assuming you have an input element with class "giphy-search" in your HTML
  var inputElement = menu.querySelector('.giphy-search');

  // Add an event listener for the "input" event on the input field
  inputElement.addEventListener('keydown', function(event) {
    if (event.keyCode === 13) { // Check if Enter key was pressed (key code 13)
      // Trigger the search when Enter key is pressed
      var query = inputElement.value;
      var url = 'https://api.giphy.com/v1/gifs/search?api_key=' + apiKey + '&q=' + encodeURIComponent(query);

      fetch(url)
        .then(response => response.json())
        .then(content => {
          // Clear previous results while preserving the input element
          menu.innerHTML = '';
          menu.appendChild(inputElement);

          content.data.forEach(gif => {
            var img = document.createElement('img');
            img.src = gif.images.fixed_height.url;
            img.alt = gif.title;
            img.className = 'giphy-img'; // Add a class for styling if necessary
            img.onclick = function() {
              selectGif(img);
            };
            menu.appendChild(img);
          });
        })
        .catch(error => {
          console.error('Error fetching from Giphy API:', error);
        });
    }
  });
}



function selectGif(selectedGifUrl) {
  console.log('Selected GIF URL:', selectedGifUrl.src);

  // Assuming 'selectedGifUrl' is an element, find the closest form
  const form = selectedGifUrl.closest('form');
  
  // Display the image preview container
  const imagePreviewContainer = form.querySelector('.image-preview-container');
  if (imagePreviewContainer) {
      imagePreviewContainer.style.display = 'block';
  }

  // Set the source of the image preview to the selected GIF URL
  const imagePreview = form.querySelector('.image-preview');
  if (imagePreview) {
      imagePreview.src = selectedGifUrl.src;
  }

  // Display the progress container
  const progressContainer = form.querySelector('.progress-container');
  if (progressContainer) {
      progressContainer.style.display = 'block';
  }

  // Hide the SVG progress bar
  const svgProgressBar = form.querySelector('.svg-progress-bar');
  if (svgProgressBar) {
      svgProgressBar.style.display = 'none';
  }

  // Update the GIF URL input field and disable the file upload
  const gifUrlInput = form.querySelector('.gif-url');
  if (gifUrlInput) {
      gifUrlInput.value = selectedGifUrl.src;
      gifUrlInput.disabled = false;
  }
  console.log(gifUrlInput.value);

  const fileUploadInput = form.querySelector('.file-upload');
  if (fileUploadInput) {
      fileUploadInput.disabled = true;
  }
}
function autoResizeTextarea(textarea) {
  textarea.style.height = 'auto';
  textarea.style.height = textarea.scrollHeight + 'px';
}
function toggleButtonOpacity(textarea) {
  const button = document.getElementById('postButton');
  if (textarea.value.trim().length > 0 && button.disabled == true) {
    button.style.opacity = 1;
    button.disabled = false;
  } else if (textarea.value.trim().length == 0 && document.getElementById('file-upload').value == "") {
    button.style.opacity = 0.5;
    button.disabled = true;
  }
}
function confirmDeleteComment(postId) {
  document.getElementById('deleteConfirmationModalComment').style.display = 'block';
  document.getElementById('commentId_delete').value = postId;
  var element = document.getElementById("head");
  element.style.borderColor = '#8A8E90';
  element.style.background = 'rgba(153,153,153,1)';
  element.style.color = '#5B111D';
  document.querySelector('.dropdown-menu-post__content').style.display = 'none';
  document.querySelector('.dropdown-menu-post__icon').classList.toggle('active');

}
// Function to show the modal
function confirmDelete(postId) {
  document.getElementById('deleteConfirmationModal').style.display = 'block';
  document.getElementById('postId_delete').value = postId;
  console.log(document.getElementById('postId_delete').value);
  var element = document.getElementById("head");
  element.style.borderColor = '#8A8E90';
  element.style.background = 'rgba(153,153,153,1)';
  element.style.color = '#5B111D';
  document.querySelector('.dropdown-menu-post__content').style.display = 'none';
  document.querySelector('.dropdown-menu-post__icon').classList.toggle('active');

}



function closeModalcomment() {
  document.getElementById('deleteConfirmationModalComment').style.display = 'none';
  var element = document.getElementById("head");
  element.style.borderColor = '#e6ecf0';
  element.style.background = 'white';
  element.style.color = '#9b1c31';
  


}
// Function to close the modal
function closeModal() {
  document.getElementById('deleteConfirmationModal').style.display = 'none';
  var element = document.getElementById("head");
  element.style.borderColor = '#e6ecf0';
  element.style.background = 'white';
  element.style.color = '#9b1c31';
  


}
function submitDeleteFormcomment() {
  // You might want to add additional logic here
  document.getElementById('deleteFormcomment').submit();
  var element = document.getElementById("head");
  element.style.borderColor = '#e6ecf0';
  element.style.background = 'white';
  element.style.color = '#9b1c31';


}
// Function that gets called when the actual form needs to submit
function submitDeleteForm() {
  // You might want to add additional logic here
  document.getElementById('deleteForm').submit();
  var element = document.getElementById("head");
  element.style.borderColor = '#e6ecf0';
  element.style.background = 'white';
  element.style.color = '#9b1c31';


}

function validateForm() {
  var selectedChannel = document.getElementById('selectedChannel').value;
  var selectedTopic = document.getElementById('selectedTopic').value;

  if (selectedChannel === '' || selectedTopic === '') {
    alert('Please select both a channel and a topic.');
    return false; // Prevent form submission
  }
  return true; // Allow form submission
}

function toggleUploadButton(fileInput) {
  const button = document.getElementById('postButton');

  // Check if a file is selected
  if (fileInput.files && fileInput.files.length > 0 && button.disabled == true) {
    button.style.opacity = 1;
    button.disabled = false;
  } else if ((fileInput.files) && (fileInput.files.length == 0) && (document.getElementById("postContent").value == "")) {
    button.style.opacity = 0.5;
    button.disabled = true;
  }
}

function fetchAndDisplayEmotes(menu,type) {
  const emoteAPIUrl = 'https://emoji-api.com/emojis?access_key=2b0abf9d1f16445afa81cf44e4496c7e69061278';
  const container = menu;

  // Show the container
  container.style.display = 'block';

  // Fetch emotes from the API
  fetch(emoteAPIUrl)
      .then(response => response.json())
      .then(data => {
          data.forEach(emoji => {
              const span = document.createElement('span');
              span.className = 'emote';
              span.textContent = emoji.character; // Displaying the emoji character
              span.onclick = () => insertEmoji(emoji.character, span,type) // Add click event
              container.appendChild(span);
          });
      })
      .catch(error => console.error('Error:', error));
}

// function insertEmoji(character) {
//   const textarea = document.getElementById('postContent');
//   textarea.value += character; // Append the emoji character to the textarea
// }
function insertEmoji(character, emojiElement,type) {
  if(type==1){
  const inputField = emojiElement.closest('.comment-wrapper').querySelector('.input-comment');
  if (inputField) {
    const currentValue = inputField.value;
    const newValue = currentValue + character;
    inputField.value = newValue;
  }
}
else if(type==0)
{
  
  const textarea = emojiElement.closest('form').querySelector('textarea');
textarea.value += character; // Append the emoji character to the textarea
}
}

//*** */
  function fetchLikeCount(postId,type) {
    var xhr = new XMLHttpRequest();
    console.log(type);
    xhr.open("GET", "likeNumbers.php?postId=" + postId +"&likedType=" + type, true);
    xhr.onreadystatechange = function() {
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        // Update the like count display
        var likeCountDisplay = document.querySelector('.likeButton[data-post-id="' + postId + '"] .likeCount');
        console.log(this.responseText);
        if (likeCountDisplay !== null) {
          likeCountDisplay.textContent = this.responseText;
        }
      }
    };
    xhr.send();
  }
function addLike( likedId,type, button) {
  var xhr = new XMLHttpRequest();
  var likedType = type; // Assuming this is for liking posts
  xhr.open("POST", "addlike.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
          button.classList.add('liked');
          console.log(this.responseText);
      }
  }
  xhr.send("likedId=" + likedId + "&likedType=" + likedType);

}

function deleteLike(likedId,type, button) {
  var xhr = new XMLHttpRequest();
  var likedType = type; // Assuming this is for liking posts
  xhr.open("POST", "deletelike.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
          button.classList.remove('liked');
          console.log(this.responseText);
      }
  }
  xhr.send("likedId=" + likedId + "&likedType=" + likedType);
}
function checkIfLiked(likedId,type, button) {
  var xhr = new XMLHttpRequest();
  var likedType = type; 
  xhr.open("POST", "checkliked.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
          if (this.responseText === "true") {
            console.log("hello");
              button.classList.add('liked');
          }
      }
  }
  xhr.send("likedId=" + likedId + "&likedType=" + likedType); // Assuming 'post' as the liked type
}


document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll('.likeButton').forEach(post => {
    var postId = post.getAttribute('data-post-id');
    var type=post.getAttribute('data-post-type');
    fetchLikeCount(postId,type);
}); 
document.querySelectorAll('.likeButton').forEach(button => {
  var likedId = button.getAttribute('data-post-id');
  var type=button.getAttribute('data-post-type');
  checkIfLiked(likedId,type, button);
  // Check if the post is already liked by this user
  

  button.addEventListener('click', function() {
      console.log(button);
      
      if (this.classList.contains('liked')) {
          // If the post is already liked, delete the like
          var postId = button.getAttribute('data-post-id');
          var type=button.getAttribute('data-post-type');
          deleteLike(likedId,type,this);
          fetchLikeCount(postId,type);
      } else {
          // If the post is not liked, add the like
          var postId = button.getAttribute('data-post-id');
          var type=button.getAttribute('data-post-type');
          addLike(likedId,type,this);
          fetchLikeCount(postId,type);
      }
      checkIfLiked(likedId, button);
  }); 
});


 



  //µµµµµµµµµµµµµµµ

  document.querySelector('.emote-container').addEventListener('click', function(event) {
    event.stopPropagation(); // This prevents the document click listener from hiding the menu when a GIF is clicked
  });
  document.querySelectorAll('.option').forEach(function(option) {
    option.addEventListener('click', function(event) {
        event.stopPropagation();
    });
});

// Event listener for document to hide the menu when clicking outside
document.addEventListener('click', function() {
    document.querySelectorAll('.giphy-menu').forEach(function(menu) {
        if (menu.style.display === 'block') {
            menu.style.display = 'none';
        }
    });
})

var logoutOption = document.getElementById('logoutOption');

    // Add a click event listener to the logout element
    logoutOption.addEventListener('click', function() {
        // Redirect to index.php when the logout element is clicked
        window.location.href = '../Login/index.php';
    });

 
 

      
  //***************************** */
  var studyContainer = document.getElementById("study");
  const dropdownIcons = document.querySelectorAll('.dropdown-menu-post__icon');
  const dropdownContents = document.querySelectorAll('.dropdown-menu-post__content');
  console.log(dropdownIcons);


  const removeImageButton = document.getElementById('remove-image-btn');
  const imagePreviewContainer = document.getElementById('image-preview-container');
  const fileUploadInput = document.getElementById('file-upload');
// Select all remove image buttons
const removeImageButtonsCmnt = document.querySelectorAll('.remove-image-btn-cmnt');

// Loop through all buttons and add an event listener to each
removeImageButtonsCmnt.forEach(function(removeImageButtoncmnt) {
    removeImageButtoncmnt.addEventListener('click', function () {
        // Find the closest image preview container relative to the clicked button
        const imagePreviewContainercmnt = removeImageButtoncmnt.closest('.comment-wrapper').querySelector('.image-preview-container');
        
        if (imagePreviewContainercmnt) {
            // Hide the image preview container
            imagePreviewContainercmnt.style.display = 'none';

            // Remove the src from the image to release the object URL if it was used
            const imagePreview = imagePreviewContainercmnt.querySelector('.image-preview-cmnt');
            if (imagePreview && imagePreview.src) {
                URL.revokeObjectURL(imagePreview.src);
                imagePreview.src = '';
            }

            // Find the file upload input related to this comment
            const fileUploadInput = removeImageButtoncmnt.closest('.comment-section').querySelector('.file-upload-input-cmnt');
            if (fileUploadInput) {
                // Clear the value of the file input
                fileUploadInput.value = '';

                // Update the button state if needed
                const postContentInput = document.getElementById("postContent");
                if (postContentInput && postContentInput.value == "") {
                    toggleUploadButton(fileUploadInput); // Modify this function according to your needs
                }
            }
        }
    });
})

  removeImageButton.addEventListener('click', function () {
    // Hide the image preview container
    imagePreviewContainer.style.display = 'none';
    // Remove the src from the image to release the object URL if it was used
    const imagePreview =  imagePreviewContainer.closest('.image-preview');
    if (imagePreview.src) {
      URL.revokeObjectURL(imagePreview.src);
      imagePreview.src = '';
    }
    // Clear the value of the file input
    fileUploadInput.value = '';
    // Update the button state
    if (document.getElementById("postContent").value == "")
      toggleUploadButton(fileUploadInput);
  });



  function toggleDropdown(dropdownContent, icon) {
    dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
    icon.classList.toggle('active');
}

  // Toggle the display of the dropdown content on click
  dropdownIcons.forEach((icon, index) => {
    icon.addEventListener('click', function (e) {
        // Prevent the click from propagating to the window
        e.stopPropagation();
        console.log(dropdownContents[index]);

        // Toggle the corresponding dropdown content
        toggleDropdown(dropdownContents[index], this);
    });
});

// Close all dropdowns if clicked outside of them
window.addEventListener('click', function () {
    dropdownContents.forEach((content, index) => {
        if (content.style.display === 'block') {
            content.style.display = 'none';
            dropdownIcons[index].classList.remove('active');
        }
    });
});   


  function toggleActiveClass() {
    studyContainer.classList.toggle("active");

  }

  if (studyContainer) {
    studyContainer.addEventListener("click", toggleActiveClass);

    studyContainer.addEventListener("keydown", function (event) {
      if (event.key === "Enter" || event.key === " ") {
        toggleActiveClass();
      }
    });

  }
  var dropbtn = document.getElementById('dropbtn');
  console.log(dropbtn);
  var dropdownContent = document.getElementById('dropdown-content');
  var selectedOptionsContainer = document.getElementById('selected-options');
  var selectedOptions = new Set(); // Use a Set to store unique values
  var dropbtn2 = document.getElementById('dropbtn2');
  var dropdownContent2 = document.getElementById('dropdown-content2');
  var hashtagSign = document.getElementById('hashtag-sign');
  var selectedChannels = [];
  // Assuming selectedChannels is declared and initialized elsewhere
  // var selectedChannels = [...];
  document.querySelector('#dropdown-content2').addEventListener('click', function (e) {
    e.preventDefault();

    var topicValue = e.target.getAttribute('data-value');
    document.querySelector('#selectedTopic').value = topicValue;

    // Update the visual display of the selected topic
    document.querySelector('#hashtag-sign').textContent = topicValue;
  });
  const allChannels = ['General_Chat', 'Area_Chat', 'University_Chat', 'Class_Chat', 'Private_Chat'];

  document.querySelector('#dropdown-content').addEventListener('click', function (e) {
    e.preventDefault(); // Prevent the default link behavior

    var channelValue = e.target.getAttribute('data-value');

    if (channelValue === 'All_Channels') {
      // Check if 'All Channels' is already selected by checking its class
      if (e.target.classList.contains('selected')) {
        // If 'All Channels' is unselected, empty the selectedChannels array
        selectedChannels = [];
        // Update visual state for all items (remove 'selected' class)
        document.querySelectorAll('#dropdown-content [data-value]').forEach(item => {
          item.classList.remove('selected');
        });
      } else {
        // If 'All Channels' is selected, set to all predefined channels
        selectedChannels = [...allChannels];
        // Update visual state for all items (add 'selected' class)
        document.querySelectorAll('#dropdown-content [data-value]').forEach(item => {
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
    document.querySelector('#selectedChannel').value = selectedChannels.join(',');
    console.log(document.querySelector('#selectedChannel').value);
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

  function updateSelectedOptionsDisplay() {
    selectedOptionsContainer.innerHTML = ''; // Clear current content

    // Define the order of the tags
    const orderedOptions = ['General_Chat', 'Area_Chat', 'University_Chat', 'Class_Chat', 'Private_Chat'];

    // Function to remove a tag
    function removeTag(option) {
      selectedOptions.delete(option);
      updateSelectedOptionsDisplay();
    }

    // Function to remove all tags
    function removeAllTags() {
      selectedOptions.clear();
      updateSelectedOptionsDisplay();
    }

    // Update visual state of dropdown items
    document.querySelectorAll('#dropdown-content a').forEach(a => {
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

    updateSelectedOptionsDisplay();
  });

  // Close the dropdown when clicking outside
  window.addEventListener('click', function (e) {
    if (!dropbtn.contains(e.target) && !dropdownContent.contains(e.target)) {
      dropdownContent.style.display = 'none';
    }
  });

  // Call the function when the page loads
  updateSelectedOptionsDisplay();
  document.getElementById('file-upload').addEventListener('change', function (event) {
    var file = event.target.files[0];
    var reader = new FileReader();

    reader.onload = function (e) {
      document.getElementById('image-preview').src = e.target.result;
      document.getElementById('image-preview-container').style.display = 'block';
      document.getElementById('progress-container').style.display = 'block';
      uploadFile(file); // Call function to handle the file upload
      document.getElementById('gif-url').disabled = true;
      document.getElementById('file-upload').disabled = false;
    };

    reader.readAsDataURL(file);
  });

  function uploadFile(file) {
    var xhr = new XMLHttpRequest();
    var formData = new FormData();
    formData.append('file', file);

    xhr.upload.onprogress = function (event) {
      if (event.lengthComputable) {
        var percentComplete = (event.loaded / event.total) * 100;
        setProgress(percentComplete);
      }
    };

    xhr.open('POST', '/Unify_SocialNetwork/View/FrontOffice/Home/postD.php', true); // Replace '/upload-url' with your upload endpoint
    xhr.send(formData);

    xhr.onload = function () {
      if (xhr.status === 200) {
        console.log("Upload complete");
        // Hide the progress bar
        document.getElementById('svg-progress-bar').style.display = 'none';
      } else {
        console.log("Upload error: " + xhr.status);
        // Handle error here
      }
    };
  }

  function setProgress(percent) {
    var progressBar = document.getElementById('progress-bar');
    var circumference = 2 * Math.PI * 45; // Circumference of the circle
    var offset = circumference - (percent / 100) * circumference;
    progressBar.setAttribute('stroke-dashoffset', offset);
  }




});

