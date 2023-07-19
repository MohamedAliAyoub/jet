<template>
    <div class="card flex justify-content-center">
        <Toast />
        <!-- <button @click="show()" >Click Me</button> -->
    </div>
</template>

<script>
import Toast from 'primevue/toast';

export default {
    components: {
        Toast,
    },
    methods: {
        show() {
            // this.$toast.add({ severity: 'info', summary: 'Info', detail: 'Message Content', life: 3000 * 3000 });
        }
    },
    watch: {
        '$page.props.toastr': {
            handler() {
                if (this.$page.props.toastr != null) {
                    Object.entries(this.$page.props.toastr).forEach(entry => {
                        this.$toast.add({
                            severity: entry[1]['type'],
                            summary: this.$t('base.' + entry[1]['type']),
                            detail: entry[1]['message'],
                            life: 3000
                        });

                    })
                }
            },
            deep: true
        },
        '$page.props.errors': {
            handler() {
                if (this.$page.props.errors != null) {
                    let i = 0;
                    for (let item in this.$page.props.errors) {
                        if (i === 0) {
                            this.$toast.add({
                                severity: 'error',
                                summary: this.$t('base.error'),
                                detail: this.$page.props.errors[item],
                                life: 5000
                            });
                        }
                        i++;
                    }
                }
            },
            deep: true,
        },
    },
}
</script>
