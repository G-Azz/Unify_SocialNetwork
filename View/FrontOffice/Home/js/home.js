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
    const selectElement = document.getElementById("chat-channel");
        const selectedChannelsContainer = document.getElementById("selected-channels");

        const channelColors = {
            "General_Chat": "#1DA1F2",
            "Area_Chat": "#FF5733",
            "University_Chat": "#46C498",
            "Class_Chat": "#FFC300",
            "Private_Chat": "#8E44AD",
        };

        selectElement.addEventListener("change", updateSelectedChannels);

        function updateSelectedChannels() {
            const selectedChannels = Array.from(selectElement.selectedOptions).map(option => option.value);
            const Channelstocheck=["General_Chat","Area_Chat","University_Chat","Class_Chat","Private_Chat"];

            // Clear the existing tags
            selectedChannelsContainer.innerHTML = "";
            
            if ((selectedChannels.includes("All_Channels")) || (Channelstocheck.every(value=>selectedChannels.includes(value)))) {
                // If "All Channels" is selected, select all other channels
                for (let i = 0; i < selectElement.options.length; i++) {
                    selectElement.options[i].selected = true;
                }
                const allTag = createTag("All", "#3498db", "#3498db");
                selectedChannelsContainer.appendChild(allTag);
            } else {
                // Create tags for selected channels (excluding "All Channels")
                selectedChannels.forEach(channel => {
                    const tag = createTag(channel, channelColors[channel], channelColors[channel]);
                    selectedChannelsContainer.appendChild(tag);
                });
            }
        }

        function createTag(text, borderColor, textColor) {
            const tag = document.createElement("div");
            tag.className = "channel-tag";
            tag.style.borderColor = borderColor;
            const tagName = document.createElement("span");
            tagName.textContent = text;
            tagName.style.color = textColor; // Set text color
            const removeButton = document.createElement("i");
            removeButton.className = "fas fa-times-circle";
            removeButton.style.color = borderColor; // Set icon color to match tag color
            removeButton.addEventListener("click", function() {
                // Remove the channel when the "x" icon is clicked
                const optionToRemove = selectElement.querySelector(`[value="${text}"]`);
                optionToRemove.selected = false;
                tag.remove();
            });

            // Use Flexbox to align the "x" icon within the tag
            const flexContainer = document.createElement("div");
            flexContainer.className = "flex-container";
            flexContainer.appendChild(tagName);
            flexContainer.appendChild(removeButton);
            tag.appendChild(flexContainer);

            return tag;
        }
        const wrapper = document.querySelector(".wrapper"),
editableInput = wrapper.querySelector(".editable"),
readonlyInput = wrapper.querySelector(".readonly"),
placeholder = wrapper.querySelector(".placeholder"),
counter = wrapper.querySelector(".counter"),
button = wrapper.querySelector("button");
editableInput.onfocus = ()=>{
  placeholder.style.color = "#c5ccd3";
}
editableInput.onblur = ()=>{
  placeholder.style.color = "#98a5b1";
}
editableInput.onkeyup = (e)=>{
  let element = e.target;
  validated(element);
}
editableInput.onkeypress = (e)=>{
  let element = e.target;
  validated(element);
  placeholder.style.display = "none";
}
function validated(element){
  let text;
  let maxLength = 100;
  let currentlength = element.innerText.length;
  if(currentlength <= 0){
    placeholder.style.display = "block";
    counter.style.display = "none";
    button.classList.remove("active");
  }else{
    placeholder.style.display = "none";
    counter.style.display = "block";
    button.classList.add("active");
  }
  counter.innerText = maxLength - currentlength;
  if(currentlength > maxLength){
    let overText = element.innerText.substr(maxLength); //extracting over texts
    overText = `<span class="highlight">${overText}</span>`; //creating new span and passing over texts
    text = element.innerText.substr(0, maxLength) + overText; //passing overText value in textTag variable
    readonlyInput.style.zIndex = "1";
    counter.style.color = "#e0245e";
    button.classList.remove("active");
  }else{
    readonlyInput.style.zIndex = "-1";
    counter.style.color = "#333";
  }
  readonlyInput.innerHTML = text; //replacing innerHTML of readonly div with textTag value
}
});
