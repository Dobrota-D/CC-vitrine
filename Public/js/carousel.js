class Carousel{

    /**
     * @param {HTMLElement} element
     * @param {Object} options
     * @param {Object} options.slideToScroll Number of items to scroll
     * @param {Object} options.slideVisible Number of elements visible in a slide
     * @param {boolean} options.loop Should we buckle at the end of the carousel
     */
    constructor (element,options = {}){
        this.element = element
        this.options = Object.assign({},{
            slideToScroll:1,
            slideVisible:1,
            loop: false
        }, options)
        let children = [].slice.call(element.children) 
        this.isMobile = true
        this.currentItem = 0
        this.root = this.createDivWithClass('carousel')
        this.container = this.createDivWithClass('carousel_container')
        this.root.appendChild(this.container)
        this.element.appendChild(this.root)
        this.items = children.map((child) => {
            let item = this.createDivWithClass('carousel_item')
            item.appendChild(child)
            this.container.appendChild(item)
            return item
        })
        this.setStyle()
        this.createNavigation()
        this.onWindowResize()
        window.addEventListener('resize', this.onWindowResize.bind(this))
    }

    /**
     * apply the correct dimensions to the elements of the carousel
     */

    setStyle(){
        let ratio = this.items.length / this.slideVisible
        this.container.style.width = (ratio * 100) + "%"
        this.items.forEach(item => item.style.width = ((100 / this.slideVisible) / ratio) + "%")
    }

    createNavigation(){
        let nextButton = this.createDivWithClass('carousel_next')
        let prevButton = this.createDivWithClass('carousel_prev')
        this.root.appendChild(nextButton)
        this.root.appendChild(prevButton)
        nextButton.addEventListener('click', this.next.bind(this))
        prevButton.addEventListener('click', this.prev.bind(this))
    }

    next(){
        this.goToItem(this.currentItem + this.slideToScroll)
    }

    prev(){
        this.goToItem(this.currentItem - this.slideToScroll)
    }

    /**
     * move the carousel to the targeted element
     * @param {number} index 
     */
    goToItem(index){
        if (index < 0){
            index = this.items.length - this.options.slideVisible
        } else if (index >= this.items.length || this.items[this.currentItem + this.options.slideVisible] === undefined && index > this.currentItem){
            index = 0
        }
        let translateX = index * -100 / this.items.length
        this.container.style.transform = 'translate3d(' + translateX + '%, 0, 0)'
        this.currentItem = index
    }

    /**
     * 
     * @param {string} className 
     * @returns {HTMLElement}
     */
    createDivWithClass(className){
        let div = document.createElement('div')
        div.setAttribute('class', className)
        return div
    }
    /** 
     * @returns {number}
     */
    get slideToScroll(){
        return this.isMobile ? 1 : this.options.slideToScroll
    }
    /** 
     * @returns {number}
     */
    get slideVisible(){
        return this.isMobile ? 1 : this.options.slideVisible
    }
    onWindowResize(){
        let mobile = window.innerWidth < 760
        if(mobile !== this.isMobile){
            this.isMobile = mobile
            this.setStyle()
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {

    new Carousel(document.querySelector('#carousel1'),{
        slideToScroll: 1,
        slideVisible: 3,
        loop: false
    })
    new Carousel(document.querySelector('#carousel2'),{
        slideToScroll: 1,
        slideVisible: 3,
        loop: false
    })
    new Carousel(document.querySelector('#carousel3'),{
        slideToScroll: 1,
        slideVisible: 3,
        loop: false
    })
    new Carousel(document.querySelector('#carousel4'),{
        slideToScroll: 1,
        slideVisible: 3,
        loop: false
    })
})