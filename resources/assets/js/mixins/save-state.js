export default {
    watch: {
        '$data': {
            handler() {
                this.saveState();
            },
            deep: true,
        },
    },

    created() {
        this.loadState();
    },

    methods: {
        loadState() {
            console.log("load-state for ", this.getSavedStateId());
            let savedState = this.getSavedState();

            if (!savedState) {
                return;
            }

            this.$data = savedState;
        },
        saveState() {
            console.log("save-state caused by ", this.getSavedStateId());
            localStorage.setItem(this.getSavedStateId(), JSON.stringify(this.$data));
        },

        getSavedState() {
            let savedState = localStorage.getItem(this.getSavedStateId());

            if (savedState) {
                savedState = JSON.parse(savedState);
            }

            return savedState;
        },
    },
};


