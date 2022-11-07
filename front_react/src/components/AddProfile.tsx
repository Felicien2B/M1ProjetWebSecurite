import React, { useState } from "react";
import { Formik, Field, Form, ErrorMessage } from "formik";
import * as Yup from "yup";

import { addProfile } from "../services/auth.service";
import IUserProfile from "../types/user.profile";

const AddProfile: React.FC = () => {
  const [successful, setSuccessful] = useState<boolean>(false);
  const [message, setMessage] = useState<string>("");

  const initialValues: IUserProfile = {
    lastName: "",
    firstName: "",
    address: "",
    phoneNumber: "",
    email: "",
    description: "",
    friends : [],
  };

  const validationSchema = Yup.object().shape({
    lastName: Yup.string()
      .required("Le nom est obligatoire!"),
    firstName: Yup.string()
      .required("Le Prénom est obligatoire!"),
    address: Yup.string()
      .required("L'adresse est obligatoire!"),
    phoneNumber: Yup.string()
      .required("Le numéro de téléphone est obligatoire!"),
    email: Yup.string()
      .email("L'email n'est pas valide.")
      .required("L'email est obligatoire!"),
    description: Yup.string()
      .required("La description est obligatoire!"),
    
  });

  const handleRegister = (formValue: IUserProfile) => {
    const { lastName, firstName, address, phoneNumber, email, description, friends } = formValue;

    addProfile(lastName, firstName, address, phoneNumber, email, description, friends).then(
      (response) => {
        setMessage(response.data.message);
        setSuccessful(true);
      },
      (error) => {
        const resMessage =
          (error.response &&
            error.response.data &&
            error.response.data.message) ||
          error.message ||
          error.toString();

        setMessage(resMessage);
        setSuccessful(false);
      }
    );
  };

  return (
    <div className="col-md-12">
      <div className="card card-container">
        <img
          src="//ssl.gstatic.com/accounts/ui/avatar_2x.png"
          alt="profile-img"
          className="profile-img-card"
        />
        <Formik
          initialValues={initialValues}
          validationSchema={validationSchema}
          onSubmit={handleRegister}
        >
          <Form>
            {!successful && (
              <div>
                <div className="form-group">
                  <label htmlFor="lastName"> Nom </label>
                  <Field name="lastName" type="text" className="form-control" />
                  <ErrorMessage
                    name="lastName"
                    component="div"
                    className="alert alert-danger"
                  />
                </div>
                <div className="form-group">
                  <label htmlFor="firstName"> Prenom </label>
                  <Field name="firstName" type="text" className="form-control" />
                  <ErrorMessage
                    name="firstName"
                    component="div"
                    className="alert alert-danger"
                  />
                </div>
                <div className="form-group">
                  <label htmlFor="address"> Adresse </label>
                  <Field name="address" type="text" className="form-control" />
                  <ErrorMessage
                    name="address"
                    component="div"
                    className="alert alert-danger"
                  />
                </div>
                <div className="form-group">
                  <label htmlFor="phoneNumber"> Numéro de Téléphone </label>
                  <Field name="phoneNumber" type="text" className="form-control" />
                  <ErrorMessage
                    name="phoneNumber"
                    component="div"
                    className="alert alert-danger"
                  />
                </div>

                <div className="form-group">
                  <label htmlFor="email"> Email </label>
                  <Field name="email" type="email" className="form-control" />
                  <ErrorMessage
                    name="email"
                    component="div"
                    className="alert alert-danger"
                  />
                </div>

                <div className="form-group">
                  <label htmlFor="description"> Description </label>
                  <Field
                    name="description"
                    type="text"
                    className="form-control"
                  />
                  <ErrorMessage
                    name="description"
                    component="div"
                    className="alert alert-danger"
                  />
                </div>

                <div className="form-group">
                  <button type="submit" className="btn btn-primary btn-block">Enregistrer</button>
                </div>
              </div>
            )}

            {message && (
              <div className="form-group">
                <div
                  className={
                    successful ? "alert alert-success" : "alert alert-danger"
                  }
                  role="alert"
                >
                  {message}
                </div>
              </div>
            )}
          </Form>
        </Formik>
      </div>
    </div>
  );
};

export default AddProfile;