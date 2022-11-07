export default interface IUserProfile {
    id?: any | null,
    lastName: string,
    firstName: string,
    address: string,
    phoneNumber: string,
    email: string,
    description: string
    friends : Array<IUserProfile>
  }