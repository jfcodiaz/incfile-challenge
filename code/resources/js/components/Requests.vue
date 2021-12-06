<template>
    <div class="container">
        <div><b>Pendings</b> : {{ data[1].value }}</div>
        <div><b>Delivered</b> : {{ data[0].value }}</div>
        <div><b>Total</b> : {{ total }}</div>
        <Chart 
            :def="def"
            :data="data"
        ></Chart>
            Run txhe command: <b><code>php artisan app:send-requests ${numberOfRequests}</code></b>
    </div>
</template>

<script>
    import Chart from 'vue-chartless'
    export default {
        props: ['initTotal', 'initDelivereds', 'initPendings'],
        components: {
          Chart
        },
        data: function () {
            return {
                def : {
                    type : 'pie'
                },
                data : [
                    { label: 'Delivered', value: this.initDelivereds},
                    { label: 'Pending', value: this.initPendings}
                ],
                total : this.initTotal
            };
        },
        mounted() {
            Echo.channel('channel-notifications')
            .listen('RequestDelivered', (e) => {
                this.total = e.total;
                this.data = [
                    { label: 'Delivered', value:e.delivereds, color: '#000' },
                    { label: 'Pending', value: e.pendings, clor: '#444'}
                ]
            });
            console.log('Component mounted.')
        }
    }
</script>
