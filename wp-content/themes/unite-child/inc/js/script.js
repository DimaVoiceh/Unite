class Filter {
    constructor(data) {

        this.wrap = document.querySelector(data.wrapSelector)
        this.linkSelector = data.linkSelector;
        this.links = document.querySelectorAll(data.linkSelector)
        this.filterParam = data.filterParam;
        this.url = data.ajaxUrl;

        this.id = null

        if (!this.wrap || !this.links || !this.url) return;

        this.currentUrl = new URL(window.location.href);

        this.init()
    }

    init() {

        const idFromCurrentUrl = this.currentUrl.searchParams.get(this.filterParam);
        if (idFromCurrentUrl) {
            this.id = idFromCurrentUrl;
        }

        document.addEventListener("click", async (e) => {
            if (!e.target.closest(this.linkSelector)) return;
            e.preventDefault();
            const link = e.target.closest(this.linkSelector);
            this.id = link?.dataset.id;
            await this.fetchData();
        })
    }

    async fetchData() {
        this.url.searchParams.set(this.filterParam, this.id)
        this.wrap.classList.add("loading")
        try {
            const response = await fetch(this.url);
            const html = await response.text()
            if (response.ok) {
                this.wrap.innerHTML = html
            }
        } catch {
            alert('Произошла ошибка при загрузке данных, перезагрузите страницу.')

        } finally {
            this.wrap.classList.remove("loading");
            this.updateClasses()
            this.updatePageUrl()
        }
    }


    updateClasses() {
        this.links.forEach(link => {
            link.classList.toggle("active", link.dataset.id == this.id)
        });
    }
    updatePageUrl() {
        if (this.id && this.id !== "0") {
            this.currentUrl.searchParams.set(this.filterParam, this.id)
        } else {
            this.currentUrl.searchParams.delete(this.filterParam)
        }

        history.pushState(null, null, this.currentUrl);

    }
}

const initAgencyFilter = () => {
    const url = new URL(ajax.url)
    url.searchParams.set("action", "buildings")
    const agencyFilter = new Filter({
        linkSelector: ".agency-link-js",
        wrapSelector: ".buildings-wrap-js",
        ajaxUrl: url,
        filterParam: 'agency_id'
    })
}
initAgencyFilter()
