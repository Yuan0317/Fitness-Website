
 /*
 * Group 15: Yuan Tang,Lishu Yuan
 * Date: 2023-03-27
 * Section: CST 8285 section 302
 * Description: To validate the email field for Assignment 2
 * This file contains javascript code used to validate email address.
 * It contains a function called validateEmail() to check if the entered email has 
 * corrent format.
*/


function searchClasses() {
    const input = document.getElementById('searchInput').value.toUpperCase();
    const cards = document.querySelectorAll('.sport-card');
    cards.forEach(card => {
        const title = card.querySelector('h2').textContent.toUpperCase();
        card.style.display = title.includes(input) ? "" : "none";
    });
}



document.addEventListener('DOMContentLoaded', function () {
    const activitiesDropdown = document.getElementById('activitiesDropdownList');
    const sportCards = document.querySelectorAll('.sport-card');

    activitiesDropdown.addEventListener('change', function () {
        const selectedValue = this.value; 

        sportCards.forEach(function (card) {
            const categoryText = card.querySelector('p').textContent;
            const category = categoryText.split(': ')[1]; // extract type name

            if (selectedValue === 'all' || category === selectedValue) {
                card.style.display = ''; // if has matched card,show
            } else {
                card.style.display = 'none'; // or hide cards
            }
        });
    });
});

    // activitiesDropdownList.addEventListener('change', (e) => {
    //     const selectedCategory = e.target.value;
    //     const filteredActivities = activities.filter(activity => 
    //         selectedCategory === 'all' ? true : activity.category === selectedCategory
    //     );
    //     displayActivities(filteredActivities);
    // });

    // // Initially display all activities
    // displayActivities(activities);
;





