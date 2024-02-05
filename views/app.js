const students = {
	data: function () {
		return {
			newItem: [],
			message: '',
			students: {},
			groups: {},
		}
	},
	mounted: function () {
		this.getData()
	},
	methods: {
		getData: function () {
			let self = this
			axios
				.get('http://localhost:8888/Pr8/index.php/students/getData')
				.then(function (response) {
					if (response.data.students) self.students = response.data.students
					if (response.data.groups) self.groups = response.data.groups
				})
		},
		toFormData: function (obj) {
			const fd = new FormData()
			for (let i in obj) {
				fd.append(i, obj[i])
			}
			return fd
		},

		addStudent: function () {
			if (this.newItem) {
				let self = this
				const formData = this.toFormData(this.newItem)
				axios
					.post(
						'http://localhost:8888/Pr8/index.php/students/addStudent',
						formData
					)
					.then(response => {
						self.getData()
						self.newItem = []
						self.message = 'Студент успешно добавлен'
						setTimeout(() => {
							self.message = ''
						}, 5000)
					})
			}
		},
		updateStudent: function (student) {
			let self = this
			if (student) {
				const formData = this.toFormData(student)
				formData.append('update', student.id)

				axios
					.post(
						'http://localhost:8888/Pr8/index.php/students/actions',
						formData
					)
					.then(() => {
						this.getData()
						this.newItem = []
						this.message = 'Студент успешно изменен'
						setTimeout(() => {
							this.message = ''
						}, 5000)
					})
			}
		},
		deleteStudent: function (student) {
			let self = this
			if (student) {
				const formData = this.toFormData(student)
				formData.append('delete', student.id)

				axios
					.post(
						'http://localhost:8888/Pr8/index.php/students/actions',
						formData
					)
					.then(() => {
						this.getData()
						this.newItem = []
						this.message = 'Студент успешно удален'
						setTimeout(() => {
							this.message = ''
						}, 5000)
					})
			}
		},
	},
	template: `
  <div>
  <form @submit.prevent="addStudent()">
            <div class="msg" v-if="message">{{message}}</div>
            <input type="text" v-model="newItem.name" placeholder="Name" required /><br>
            <select v-model="newItem.group_id" v-if="groups">
                <option v-for="g in groups" :value="g.id">{{g.name}}</option>
            </select><br>
            <input type="submit" value="Добавить">

        </form>

        <table v-if="students">
            <tr>
            <th>Ім'я</th>
            <th>Група</th>
            <th>Оновити</th>
            <th>Видалити</th>
            </tr>
            <tr v-for="s in students">
            <td><input v-model="s.name"></td>
            <td>
                <select v-model="s.group_id" v-if="groups">
                <option v-for="g in groups" :value="g.id">{{g.name}}</option>
                </select>
            </td>
            <td><button type="submit" @click.prevent="updateStudent(s)" name="update">Оновити</button></td>
            <td><button type="submit" @click.prevent="deleteStudent(s)" name="delete">Видалити</button></td>
            </tr>
        </table>  </div>
  `,
}

const subject = {
	data: function () {
		return {
			newItem: [],
			message: '',
			subjects: {},
		}
	},
	mounted: function () {
		this.getData()
	},
	methods: {
		getData: function () {
			let self = this
			axios
				.get('http://localhost:8888/Pr8/index.php/subjects/getData')
				.then(function (response) {
					if (response.data.subjects) self.subjects = response.data.subjects
				})
		},

		toFormData: function (obj) {
			const fd = new FormData()
			for (let i in obj) {
				fd.append(i, obj[i])
			}
			return fd
		},

		addSubject: function () {
			if (this.newItem) {
				let self = this
				const formData = this.toFormData(this.newItem)
				axios
					.post(
						'http://localhost:8888/Pr8/index.php/subjects/addSubject',
						formData
					)
					.then(response => {
						self.getData()
						self.newItem = []
						self.message = 'Предмет успешно добавлен'
						setTimeout(() => {
							this.message = ''
						}, 5000)
					})
			}
		},
		updateSubject: function (subject) {
			let self = this
			if (subject) {
				const formData = this.toFormData(subject)
				formData.append('update', subject.id)

				axios
					.post(
						'http://localhost:8888/Pr8/index.php/subjects/actions',
						formData
					)
					.then(() => {
						this.getData()
						this.newItem = []
						this.message = 'Предмет успешно изменен'
						setTimeout(() => {
							this.message = ''
						}, 5000)
					})
			}
		},
		deleteSubject: function (subject) {
			let self = this
			if (subject) {
				const formData = this.toFormData(subject)
				formData.append('delete', subject.id)

				axios
					.post(
						'http://localhost:8888/Pr8/index.php/subjects/actions',
						formData
					)
					.then(() => {
						this.getData()
						this.newItem = []
						this.message = 'Предмет успешно удален'
						setTimeout(() => {
							this.message = ''
						}, 5000)
					})
			}
		},
	},
	template: `
  <div>
  <form @submit.prevent="addSubject()">
            <div class="msg" v-if="message">{{message}}</div>
            <input type="text" v-model="newItem.name" placeholder="Name" required />
            <input type="submit" value="Добавить">
        </form>

        <table v-if="subjects">
            <tr>
            <th>Ім'я</th>

            </tr>
            
            <tr v-for="s in subjects">
            <td><input v-model="s.name"></td>
            
            <td><button type="submit" @click.prevent="updateSubject(s)" name="update">Оновити</button></td>
            <td><button type="submit" @click.prevent="deleteSubject(s)" name="delete">Видалити</button></td>
            </tr>
        </table>  </div>
  `,
}

const progress = {
	data: function () {
		return {
			newItem: [],
			message: '',
			students: {},
			progress: {},
			subjects: {},
		}
	},
	mounted: function () {
		this.getData()
	},
	methods: {
		getData: function () {
			let self = this
			axios
				.get('http://localhost:8888/Pr8/index.php/progress/getData')
				.then(function (response) {
					if (response.data.students) self.students = response.data.students
					if (response.data.progress) self.progress = response.data.progress
					if (response.data.subjects) self.subjects = response.data.subjects
				})
		},
		toFormData: function (obj) {
			const fd = new FormData()
			for (let i in obj) {
				fd.append(i, obj[i])
			}
			return fd
		},

		addProgress: function () {
			if (this.newItem) {
				let self = this
				const formData = this.toFormData(this.newItem)
				axios
					.post(
						'http://localhost:8888/Pr8/index.php/progress/addProgress',
						formData
					)
					.then(response => {
						self.getData()
						self.newItem = []
						self.message = 'Успеваемость успешно добавлена'
						setTimeout(() => {
							self.message = ''
						}, 5000)
					})
			}
		},
		updateStudent: function (progress) {
			let self = this
			if (progress) {
				const formData = this.toFormData(progress)
				formData.append('update', progress.id)

				axios
					.post(
						'http://localhost:8888/Pr8/index.php/progress/actions',
						formData
					)
					.then(() => {
						this.getData()
						this.newItem = []
						this.message = 'Успеваемость успешно изменена'
						setTimeout(() => {
							this.message = ''
						}, 5000)
					})
			}
		},
		deleteProgress: function (progress) {
			let self = this
			if (progress) {
				const formData = this.toFormData(progress)
				formData.append('delete', progress.id)

				axios
					.post(
						'http://localhost:8888/Pr8/index.php/progress/actions',
						formData
					)
					.then(() => {
						this.getData()
						this.newItem = []
						this.message = 'Успеваемость успешно удалена'
						setTimeout(() => {
							this.message = ''
						}, 5000)
					})
			}
		},
	},
	template: `
  <div>
  <form @submit.prevent="addProgress()">
            <div class="msg" v-if="message">{{message}}</div>
            <input type="number" name="mark"  v-model="newItem.mark" placeholder="Mark" required /><br>

            <select v-model="newItem.student_id">
                <option v-for="s in students" :value="s.id">{{ s.name }}</option>
            </select><br>
            <select v-model="newItem.subject_id">
                <option v-for="subject in subjects" :value="subject.id">{{ subject.name }}</option>
            </select><br>
            <input type="submit" value="Добавить">
        </form>

    
        <table v-if="progress">
            <tr>
                <th>Имя</th>
                <th>Предмет</th>
                <th>Оценка</th>
                <th>Действие</th>
            </tr>
            <tr v-for="p in progress" :key="p.id">
                <td>
                    <select v-model="p.student_id">
                        <option v-for="s in students" :value="s.id" :selected="s.id === p.student_id">{{ s.name }}</option>
                    </select>
                </td>
                <td>
                    <select v-model="p.subject_id">
                        <option v-for="subject in subjects" :value="subject.id" :selected="subject.id === p.subject_id">{{ subject.name }}</option>
                    </select>
                </td>
                <td><input type="text" v-model="p.mark" placeholder="mark" required /></td>
                <td>
                    <button type="button" @click="deleteProgress(p)">Delete</button>
                    <button type="button" @click="updateStudent(p)">Update</button>
                </td>
            </tr>
        </table></div>
  `,
}

const app = new Vue({
	router: new VueRouter({
		routes: [
			{ path: '/students', component: students },
			{ path: '/subject', component: subject },
			{ path: '/progress', component: progress },
		],
	}),
	el: '#app',
	mounted: function () {
		this.page('/students')
	},
	methods: {
		page: function (path) {
			this.$router.replace(path)
		},
	},
})
