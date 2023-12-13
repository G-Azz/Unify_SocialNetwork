function autoResizeTextarea(textarea) {
  textarea.style.height = 'auto';
  textarea.style.height = textarea.scrollHeight + 'px';
}
function toggleButtonOpacity(textarea) {
  const button = document.getElementById('postButton');
  if (textarea.value.trim().length > 0  && button.disabled==true) {
    button.style.opacity = 1;
    button.disabled = false;
  } else {
    button.style.opacity = 0.5;
    button.disabled = true;
  }
}
function toggleUploadButton(fileInput) {
  const button = document.getElementById('postButton');

  // Check if a file is selected
  if (fileInput.files && fileInput.files.length > 0) {
    button.style.opacity = 1;
    button.disabled = false;
  } else {
    button.style.opacity = 0.5;
    button.disabled = true;
  }
}






document.addEventListener("DOMContentLoaded", function() {
    var studyContainer = document.getElementById("study");
    
    function toggleActiveClass() {   
        studyContainer.classList.toggle("active");
       
    }

    if (studyContainer) {
        studyContainer.addEventListener("click", toggleActiveClass);

        studyContainer.addEventListener("keydown", function(event) {
            if (event.key === "Enter" || event.key === " ") {
                toggleActiveClass();
            }
        });

    }
    var dropbtn = document.getElementById('dropbtn');
    var dropdownContent = document.getElementById('dropdown-content');
    var selectedOptionsContainer = document.getElementById('selected-options');
    var selectedOptions = new Set(); // Use a Set to store unique values
    var dropbtn2 = document.getElementById('dropbtn2');
    var dropdownContent2 = document.getElementById('dropdown-content2');
    var hashtagSign = document.getElementById('hashtag-sign');
    var selectedChannels = [];
 // Assuming selectedChannels is declared and initialized elsewhere
// var selectedChannels = [...];
document.querySelector('#dropdown-content2').addEventListener('click', function(e) {
  e.preventDefault();
  
  var topicValue = e.target.getAttribute('data-value');
  document.querySelector('#selectedTopic').value = topicValue;

  // Update the visual display of the selected topic
  document.querySelector('#hashtag-sign').textContent = topicValue;
}); 
const allChannels = ['General_Chat', 'Area_Chat', 'University_Chat', 'Class_Chat', 'Private_Chat'];

document.querySelector('#dropdown-content').addEventListener('click', function(e) {
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
    document.getElementById('file-upload').addEventListener('change', function(event) {
      var file = event.target.files[0];
      var reader = new FileReader();
      
      reader.onload = function(e) {
          document.getElementById('image-preview').src = e.target.result;
          document.getElementById('image-preview-container').style.display = 'block';
          document.getElementById('progress-container').style.display = 'block';
          uploadFile(file); // Call function to handle the file upload
      };
  
      reader.readAsDataURL(file);
  });
  
  function uploadFile(file) {
      var xhr = new XMLHttpRequest();
      var formData = new FormData();
      formData.append('file', file);
  
      xhr.upload.onprogress = function(event) {
          if (event.lengthComputable) {
              var percentComplete = (event.loaded / event.total) * 100;
              setProgress(percentComplete);
          }
      };
  
      xhr.open('POST', '/Unify_SocialNetwork/View/FrontOffice/Home/postD.php', true); // Replace '/upload-url' with your upload endpoint
      xhr.send(formData);
  
      xhr.onload = function() {
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
      var offset = circumference - (percent/100) * circumference;
      progressBar.setAttribute('stroke-dashoffset', offset);
  }




});

