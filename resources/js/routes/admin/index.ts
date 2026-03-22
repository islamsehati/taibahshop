import cabang from './cabang'
import mitra from './mitra'
import pengguna from './pengguna'

const admin = {
    cabang: Object.assign(cabang, cabang),
    mitra: Object.assign(mitra, mitra),
    pengguna: Object.assign(pengguna, pengguna),
}

export default admin