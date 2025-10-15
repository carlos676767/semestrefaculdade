

class Menu {
    static menu = document.getElementById("menu");
    static section = document.getElementById("section");

    static open() {
        const openMenu = document.getElementById("openMenu");
        openMenu.addEventListener("click", () => {
            this.menu.classList.remove("max-md:w-0");
            this.menu.classList.add("max-md:w-full");
            this.section.classList.add("overflow-hidden");
        });
    }

    static closer() {
        const closeMenu = document.getElementById("closeMenu");
        closeMenu.addEventListener("click", () => {
            this.menu.classList.remove("max-md:w-full");
            this.menu.classList.add("max-md:w-0");
            this.section.classList.remove("overflow-hidden");
        });
    }
}

Menu.open();
Menu.closer();

class DarkMode {
    static darkMode() {
        const btn = document.getElementById(`btndark`);

        const darkmode = new Darkmode({
            autoMatchOsTheme: true,
        });
        btn.addEventListener(`click`, () => {
            darkmode.toggle();
        });
    }
}

DarkMode.darkMode();
