import React, { useState, useEffect } from 'react';
import './trackingStyles.css'; // Import CSS file

const UserProfilePage = () => {
    const [showModal, setShowModal] = useState(false);
    const [modalImgSrc, setModalImgSrc] = useState('');
    const [modalCaption, setModalCaption] = useState('');
    const [likesCount, setLikesCount] = useState(5);
    const [commentInput, setCommentInput] = useState('');
    const [comments, setComments] = useState([]);

    const handleImageClick = (src, alt) => {
        setShowModal(true);
        setModalImgSrc(src);
        setModalCaption(alt);
    };

    const handleCloseModal = () => {
        setShowModal(false);
    };

    const handlePostComment = () => {
        if (commentInput.trim() !== "") {
            setComments(prevComments => [...prevComments, commentInput]);
            setCommentInput(""); // Clear input after posting
        } else {
            alert("Please enter a comment before posting.");
        }
    };

    const handleLikeClick = () => {
        setLikesCount(prevCount => prevCount + 1);
    };

    return (
        <div>
            <section className="profile">
                <img src="C:/Users/adam6/OneDrive/Pictures/profile.jpg" alt="Profile Picture" />
                <h2>@igotogym</h2>
                <p>
                    <b>Bio:</b> I'm Alex, a dedicated gym-goer who thrives on the variety and challenge of my daily workouts. The gym is my sanctuary for
                     stress relief and mental rejuvenation, thanks to the endorphins that keep me coming back for more. I also cherish the camaraderie and 
                     motivation I find in the community of fellow fitness enthusiasts.
                </p>
            </section>
            <section className="posts">
                <div className="tabs">
                    <button className="tablink">POSTS</button>
                </div>
                <div id="Posts" className="tabcontent">
                    <img src="C:\Users\adam6\OneDrive\Pictures\burdick_daytime_m.jpg" alt="Post 1" onClick={() => handleImageClick("C:\Users\adam6\OneDrive\Pictures\burdick_daytime_m.jpg", "Post 1")} />
                    <img src="C:\Users\adam6\OneDrive\Pictures\gym1.jpg" alt="Post 2" onClick={() => handleImageClick("C:\Users\adam6\OneDrive\Pictures\gym1.jpg", "Post 2")} />
                    <img src="C:\Users\adam6\OneDrive\Pictures\gym2.jpg" alt="Post 3" onClick={() => handleImageClick("C:\Users\adam6\OneDrive\Pictures\gym2.jpg", "Post 3")} />
                </div>
            </section>
            {/* Modal Section */}
            {showModal && (
                <div id="myModal" className="modal">
                    <span className="close" onClick={handleCloseModal}>&times;</span>
                    <div className="modal-body">
                        <img className="modal-content" id="img01" src={modalImgSrc} alt={modalCaption} />
                        <div className="modal-info">
                            <div id="likes"><span id="likes-count">{likesCount}</span> Likes</div>
                            <div id="caption">{modalCaption}</div>
                            <div className="comments">
                                <textarea id="comment-input" placeholder="Add a comment..." value={commentInput} onChange={(e) => setCommentInput(e.target.value)}></textarea>
                                <button onClick={handlePostComment}>Post</button>
                                <div id="comment-section">
                                    {comments.map((comment, index) => (
                                        <p key={index}>{comment}</p>
                                    ))}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            )}
            <footer>
                <p>© 2024 Well Track</p>
            </footer>
        </div>
    );
}

export default UserProfilePage;
