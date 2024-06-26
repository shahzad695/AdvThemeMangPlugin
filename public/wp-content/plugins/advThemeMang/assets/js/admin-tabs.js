export default class AdminTabs {
  constructor() {
    this.tabItems = document.querySelectorAll(".tab__item");
    this.tabs = Array.from(this.tabItems);
    this.id = document.getElementById("tab-1");

    this.events();
  }
  // Event listeners
  events() {
    // addEventListener('load', function(e) { PR.prettyPrint(); }, false);
    this.tabs.forEach((tabPaine) => {
      console.log(tabPaine);
      tabPaine.addEventListener("click", this.switchTabsHandler);
      
    })
  }
  //  Event handlers
  switchTabsHandler(e){
    e.preventDefault();
    const activeLink = document.querySelector(".tab__item_link--active");
    const activePaine = document.querySelector(".tab__paine--active");
    activePaine.classList.remove("tab__paine--active");
    activeLink.classList.remove("tab__item_link--active");

    const clickedItem = e.target;
    const clickedTabId = clickedItem.getAttribute("href");
    console.log(clickedTabId);
    clickedItem.classList.add("tab__item_link--active");
    const clickedTab = document.getElementById(clickedTabId);
    console.log(clickedTab);
    clickedTab.classList.add("tab__paine--active");
  }
  l;
}
