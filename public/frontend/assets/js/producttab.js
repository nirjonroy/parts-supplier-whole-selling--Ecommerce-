document.addEventListener('DOMContentLoaded', function () {
    var navTabs = document.querySelector('.nav-tabs');
    var sectionBrands = document.querySelector('.section-brands');

  
    function addActiveClass() {
        navTabs.classList.add('active');
    }


    function removeActiveClass() {
        navTabs.classList.remove('active');
    }

 
    navTabs.addEventListener('click', addActiveClass);


    document.addEventListener('click', function (event) {
        if (!navTabs.contains(event.target) && !sectionBrands.contains(event.target)) {
            removeActiveClass(); 
        }
    });
});




window.onload = function () {
    var darkOverlay = document.querySelector('.dark-overlay');
    var tabContentContainer = document.querySelector('.tab-content-container');
    var productImage = document.querySelector('.product-image img');
    var compatibilityElements = document.querySelectorAll('.compatibility-text-box .compatibility-text');
    var searchInput = document.querySelector('.section-serach-others input[type="search"]');
    var productDivs = document.querySelectorAll('.section-serach-others .product-list');
    var debouncedSearchInputHandler = debounce(handleSearchInput, 300);

    // Close tab content on clicking outside
    darkOverlay.addEventListener('click', function (e) {
        if (e.target.classList.contains('dark-overlay')) {
            tabContentContainer.style.display = 'none';
            darkOverlay.style.display = 'none';
        }
    });

    // Show tab content on tab link click
    var tabLinks = document.querySelectorAll('.brands-menu');
    tabLinks.forEach(function (link) {
        link.addEventListener('click', function () {
            tabContentContainer.style.display = 'block';
            darkOverlay.style.display = 'block';
        });
    });

    // Function to handle product image and compatibility on hover
    var productItems = document.querySelectorAll('.product-list a');
    productItems.forEach(function (item) {
        item.addEventListener('mouseover', function () {
            var productName = item.textContent.trim();
            var compatibilityTexts = [];

            switch (productName) {
                case 'iPhone 15':
                    productImage.src = '/images/iphoneback/back1.jpg';
                    compatibilityTexts = ['A2489', 'A3105', 'A3106', 'A3108', 'A2643', 'A2645'];
                    break;
                case 'iPhone 13 Pro Max':
                    productImage.src = '/images/iphoneback/back2.jpg';
                    compatibilityTexts = ['A2643', 'A2484', 'A2461', 'A2644', 'A2649'];
                    break;
                case 'iPhone 13 Pro':
                    productImage.src = '/images/iphoneback/back1.jpg';
                    compatibilityTexts = ['A2123', 'A2184', 'A2431261', 'A2231644', 'A2643129'];
                    break;
                case 'iPhone 13':
                    productImage.src = '/images/iphoneback/back2.jpg';
                    compatibilityTexts = ['A2643', 'A2484', 'A2641', 'A2644', 'A2645'];
                    break;
                case 'iPhone 12 Pro Max':
                    productImage.src = '/images/iphoneback/back1.jpg';
                    compatibilityTexts = ['A2342', 'A2410', 'A2414', 'A2412', 'A2411'];
                    break;
                case 'iPhone 12 Pro':
                    productImage.src = '/images/iphoneback/back1.jpg';
                    compatibilityTexts = ['A2342QS', 'A24SD10', 'A24DS14', 'ASD2412', 'A241SD1'];
                    break;
                case 'iPhone 12 Pro':
                    productImage.src = '/images/iphoneback/back1.jpg';
                    compatibilityTexts = ['A22424', 'A22440', 'A24244', 'A243535', 'A253531'];
                    break;
                case 'iPhone 12 Pro':
                    productImage.src = '/images/iphoneback/back2.jpg';
                    compatibilityTexts = ['A5235', 'A6346', 'A523', 'A243535', 'A253531'];
                    break;
                default:
                    productImage.src = ''; 
                    clearCompatibilityText(); 
                    return;
            }

            setCompatibilityText(compatibilityTexts);
        });
    });

    // Function to set compatibility text
    function setCompatibilityText(compatibilityTexts) {
        compatibilityElements.forEach(function (element, index) {
            element.textContent = compatibilityTexts[index].trim();
            element.style.display = 'inline-block'; // Display the badge
        });
    }

    // Function to clear compatibility text
    function clearCompatibilityText() {
        compatibilityElements.forEach(function (element) {
            element.textContent = ''; // Clear text
            element.style.display = 'none'; // Hide the badge
        });
    }

    // Functionality for search
    searchInput.addEventListener('input', debouncedSearchInputHandler);

    function handleSearchInput() {
        var searchTerms = searchInput.value.trim().toLowerCase().split(' ');

        productDivs.forEach(function (productDiv) {
            var productLinks = productDiv.querySelectorAll('a');
            productLinks.forEach(function (link) {
                var productName = link.textContent.trim().toLowerCase();
                var matchAllTerms = searchTerms.every(function (term) {
                    return productName.includes(term);
                });

                link.style.display = matchAllTerms ? 'block' : 'none';
            });
        });
    }

    // Debounce function
    function debounce(func, wait, immediate) {
        var timeout;
        return function () {
            var context = this, args = arguments;
            var later = function () {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }
};
