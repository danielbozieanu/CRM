<script>
    import { Bar } from 'vue-chartjs';
    export default Bar.extend({
        mounted () {
            this.renderChart({
                labels: this.report.choices,
                datasets: [
                    {
                        label: this.report.question,
                        backgroundColor: '#f87979',
                        data: this.report.scores
                    }
                ]
            });
            console.log(this.report);
        },
        name: 'reports',
        props: ['report'],
        data() {
            return {
                text: 'Hey'
            }
        }
    })
</script>