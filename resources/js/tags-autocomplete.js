document.addEventListener("DOMContentLoaded", function (){
    const tagInput = document.getElementById("tag-input");
    const tagList = document.getElementById("list");


    tagInput.addEventListener("input", async function(){
        const term = tagInput.value.trim();
        if(term.length>0){
            const data = await retrieveData(term);
            showSuggestion(data);
        }else{
            hideSuggestion();
        }
    })
    async function retrieveData(term){
        try {
            const responce = await fetch(`/tags/search?term=${term}`);
            const data = await responce.json();
            return data;
        } catch (error) {
            return []
        }
    }

    function showSuggestion(data){
        hideSuggestion();
        const autocompleteList = document.createElement('ul');
        autocompleteList.classList.add("autocomplete-suggestion")
        if(data.length>0){
            data.forEach((tag) => {
                const listItem = document.createElement('li');
                listItem.textContent = tag;
                listItem.addEventListener("click", function() {
                    addTag(tag);
                    hideSuggestion();
                })
                const item = document.createElement('span');
                autocompleteList.appendChild(listItem);
            });
        }
        tagInput.parentElement.appendChild(autocompleteList);
    }

    function addTag(tag){
        const listItem = document.createElement('li');

        const tagText = document.createElement("span");
        tagText.textContent = tag;

        const remoteButton = document.createElement("button");
        remoteButton.textContent = "x";

        listItem.appendChild(tagText);
        listItem.appendChild(remoteButton);

        tagList.appendChild(listItem);

        remoteButton.addEventListener("click", () => {
            listItem.remove();
        });
        tagInput.value = "";
    }
    function hideSuggestion(){
        const existSuggestion = document.querySelector('.autocomplete-suggestion');
        if(existSuggestion){
            existSuggestion.remove();
        }
    }
});