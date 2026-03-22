import BranchAdminController from './BranchAdminController'
import PartnerAdminController from './PartnerAdminController'
import UserAdminController from './UserAdminController'

const Admin = {
    BranchAdminController: Object.assign(BranchAdminController, BranchAdminController),
    PartnerAdminController: Object.assign(PartnerAdminController, PartnerAdminController),
    UserAdminController: Object.assign(UserAdminController, UserAdminController),
}

export default Admin