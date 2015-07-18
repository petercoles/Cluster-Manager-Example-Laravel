v = new Vue({
	el: '#dashboard',

	data: {
		managers: 1,
		workers: 0,
		jobs: 0,
		jobStatus: 'inactive',
		documents: []
	},

	ready: function() {
		this.getClusterStatus();
		this.getDocuments();
	},

	methods: {
		getDocuments: function() {
			this.$http.get('/api/documents', function(documents) {
				this.documents = documents;
			})
		},

		getClusterStatus: function() {
			this.$http.get('/api/cluster-stats', function(stats) {
				this.managers = stats.managers;
				this.workers = stats.workers;
				this.jobs = stats.jobs;
			});

			this.setJobStatus();
		},

		setJobStatus: function() {
			if (this.jobs == 0) {
				this.jobStatus = 'inactive';
			} else if (this.workers == 0) {
				this.jobStatus = 'waiting';
			} else {
				this.jobStatus = 'active';
			}
		},

		teardown: function() {
			this.$http.get('/api/teardown');
			this.managers = 1;
			this.workers = 0;
			this.jobs = 0;
			this.documents = [];
		}
	}
});

setInterval(function(){
    v.getDocuments();
},1000);

setInterval(function(){
    v.getClusterStatus();
},10000);
